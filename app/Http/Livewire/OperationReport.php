<?php

namespace App\Http\Livewire;

use App\Exports\OperationReportExport;
use App\Http\Resources\OperationReportExportResource;
use App\Models\Driver;
use App\Models\User;
use App\Models\UserRequest;
use App\Models\VehicleType;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class OperationReport extends Component
{
    use WithPagination;

    public $fromDate = null;
    public $toDate = null;
    public $vehicleTypeId = null;
    public $driverId = null;
    public $userId = null;
    public $status = null;
    public $search = '';

    public function operationReportExcel()
    {
        $data = $this->search();
        return Excel::download(new OperationReportExport(OperationReportExportResource::collection($data)), 'operation.xlsx');
    }

    public function mount($status)
    {
        $this->status = $status;

    }

    public function search($withPaginate = true)
    {
        $operation = UserRequest::with('driver', 'user', 'vehicleType', 'dropOffs');

        /*if ((is_null($this->fromDate) ||
                is_null($this->toDate)) &&
            is_null($this->vehicleTypeId) &&
            is_null($this->driverId) &&
            is_null($this->userId) &&
            is_null($this->status)) {
            return collect([]);
        }*/

        if ($this->search) {
            $operation = $operation
                ->where('start_address', 'like', "%{$this->search}%")
                ->orWhere('status', 'like', "%{$this->search}%")
                ->orWhere('amount', 'like', "%{$this->search}%")
                ->whereHas('driver', function ($query){
                   $query->where('name', 'like', "%{$this->search}%");
                   $query->orWhere('amount', 'like', "%{$this->search}%");
                })
                ->orWhereHas('user',function ($query){
                   $query->where('name', 'like',"%{$this->search}%");
                });
        }
        if ($this->fromDate && $this->toDate) {

            $operation = $operation->whereBetween(
                'created_at',
                [
                    (new Carbon($this->fromDate))->subDay(),
                    (new Carbon($this->toDate))->addDay()
                ]
            );
        }

        if ($this->vehicleTypeId) {
            $operation = $operation
                ->whereHas('vehicleType', function ($query) {
                    $query->where('vehicle_type_id', 'like', "%{$this->vehicleTypeId}%");
                });
        }

        if ($this->driverId) {
            $operation = $operation
                ->whereHas('driver', function ($query) {
                    $query->where('driver_id', 'like', "%{$this->driverId}%");
                });
        }

        if ($this->userId) {
            $operation = $operation
                ->whereHas('user', function ($query) {
                    $query->where('user_id', 'like', "%{$this->userId}%");
                });
        }

        if ($this->status) {
            $operation = $operation
                ->where('status', 'like', "%{$this->status}%");
        }

        if (!$withPaginate) return $operation->orderBy('id', 'desc')->get();

        return $operation
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.operation-report')
            ->with([
                'drivers'      => Driver::all(),
                'users'        => User::all(),
                'vehicleTypes' => VehicleType::all(),
                'reports'      => $this->search()
            ]);
    }

}
