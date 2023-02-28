<?php

namespace App\Http\Livewire;

use App\Exports\VehicleTypeReportExport;
use App\Http\Resources\VehicleTypeReportExportResource;
use App\Models\VehicleCategory;
use App\Models\VehicleType;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class VehicleTypeReport extends Component
{

    use WithPagination;

    public $fromDate = null;
    public $toDate = null;
    public $vehicleCategoryId = null;
    public $vehicleTypeId = null;
    public $search = '';

    public function vehicleTypeReportExcel()
    {
        $data = $this->search();

        return Excel::download(new VehicleTypeReportExport(VehicleTypeReportExportResource::collection($data)), 'vehicle-type-report.xlsx');
    }

    public function search($withPaginate = true)
    {
        $vehicleType = VehicleType::with('vehicles', 'vehicleCategory', 'userRequest');

        /*if ((is_null($this->fromDate) ||
                is_null($this->toDate)) &&
            is_null($this->vehicleCategoryId) &&
            is_null($this->vehicleTypeId)) {
            return collect([]);
        }*/
        if ($this->search) {
            $vehicleType = $vehicleType
                ->orWhere('name', 'like', "%{$this->search}%")
                ->whereHas('vehicleCategory', function ($query) {
                    $query->where('name', 'like', "%{$this->search}%");
                })->orWhereHas('vehicles', function ($query) {
                    $query->where('vehicle_no', 'like', "%{$this->search}%");
                    $query->orWhere('license_no', 'like', "%{$this->search}%");
                });

        }
        if ($this->fromDate && $this->toDate) {

            $vehicleType = $vehicleType->whereBetween(
                'created_at',
                [
                    (new Carbon($this->fromDate))->subDay(),
                    (new Carbon($this->toDate))->addDay()
                ]
            );
        }

        if ($this->vehicleCategoryId) {
            $vehicleType = $vehicleType
                ->where('vehicle_category_id', $this->vehicleCategoryId);
        }

        if ($this->vehicleTypeId) {
            $vehicleType = $vehicleType
                ->where('id', 'like', "%{$this->vehicleTypeId}%");
        }

        if (!$withPaginate) return $vehicleType->orderBy('id', 'desc')->get();

        return $vehicleType
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.vehicle-type-report')
            ->with([
                'vehicleCategories'  => VehicleCategory::all(),
                'vehicleTypes'       => VehicleType::all(),
                'vehicleTypeReports' => $this->search()
            ]);
    }

}
