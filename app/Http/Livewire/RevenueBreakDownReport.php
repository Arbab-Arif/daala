<?php


namespace App\Http\Livewire;

use App\Exports\RevenueBreakDownReportExport;
use App\Http\Resources\RevenueBreakDownReportExportResource;
use App\Models\UserRequest;
use App\Models\VehicleCategory;
use App\Models\VehicleType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class RevenueBreakDownReport extends Component
{

    use WithPagination;

    public $fromDate = null;
    public $toDate = null;
    public $vehicleCategoryId = null;
    public $vehicleTypeId = null;
    public $search = '';

    public function revenueBreakDownReportExcel()
    {
        $data = $this->filter();

        return Excel::download(new RevenueBreakDownReportExport(RevenueBreakDownReportExportResource::collection($data)), 'revenue-break-down-report.xlsx');
    }

    public function mount($vehicleTypeId)
    {
        $this->vehicleTypeId = $vehicleTypeId;
    }

    public function filter($withPaginate = true)
    {

        $userRequest = UserRequest::with('vehicleType', 'driver');

        /*if ((is_null($this->fromDate) ||
                is_null($this->toDate)) &&
            is_null($this->vehicleCategoryId) &&
            is_null($this->vehicleTypeId)) {
            return collect([]);
        }*/

        if (!is_null($this->search) && $this->search !== '') {
            $userRequest->where(function ($q) {
                $q->whereHas('vehicleType', function ($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                        ->orWhereHas('vehicleCategory', function ($query) {
                            $query->where('name', 'like', "%{$this->search}%");
                        });
                })
                    ->orWhereHas('driver', function ($q) {
                        $q->where('name', 'like', "%{$this->search}%")
                            ->orWhereHas('vehicle', function ($query) {
                                $query->where('vehicle_no', 'like', "%{$this->search}%")
                                    ->where('license_no', 'like', "%{$this->search}%");
                            });
                    });
            });
        }

        if ($this->fromDate && $this->toDate) {
            $userRequest = $userRequest->whereBetween(
                'created_at',
                [
                    (new Carbon($this->fromDate))->subDay(),
                    (new Carbon($this->toDate))->addDay()
                ]
            );
        }

        if ($this->vehicleCategoryId) {
            $userRequest = $userRequest
                ->whereHas('vehicleType', function ($q) {
                    $q->where('vehicle_category_id', $this->vehicleCategoryId);
                });

        }

        if ($this->vehicleTypeId) {
            $userRequest = $userRequest
                ->whereHas('vehicleType', function ($query) {
                    $query->where('id', 'like', "%{$this->vehicleTypeId}%");
                });
        }

        if (!$withPaginate) return $userRequest->orderBy('id', 'desc')->get();

        return $userRequest
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.revenue-break-down-report')
            ->with([
                'vehicleCategories'  => VehicleCategory::all(),
                'vehicleTypes'       => VehicleType::all(),
                'userRequestReports' => $this->filter()
            ]);
    }

}
