<?php

namespace App\Http\Livewire;

use App\Exports\commercialTypeExport;
use App\Http\Resources\CommercialTypeExportResource;
use App\Models\VehicleType;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class VehicleTypeList extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $vehicleIds = [];
    public $search = '';

    protected $listeners = [
        'vehicleTypeDeleted' => 'deleteVehicleType',
        'statusUpdated' => 'updateStatusVehicleType',
    ];


    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function deleteVehicleType($id)
    {
        VehicleType::find($id)->delete();
    }

    public function commercialTypeExport()
    {
        $data = $this->filter();
        return Excel::download(new commercialTypeExport(CommercialTypeExportResource::collection($data)), 'commercial-type.xlsx');
    }

    public function updateStatusVehicleType(VehicleType $vehicle_type)
    {
        $vehicle_type->update([
            'status' => !$vehicle_type->status
        ]);
    }

    protected function filter()
    {
        $vehicle_type = VehicleType::with('vehicleCategory');

        if ($this->search) {
            $vehicle_type = $vehicle_type
                ->where('name', 'like', "%{$this->search}%")
                ->orWhere('base_fare', 'like', "%{$this->search}%")
                ->orWhere('per_km', 'like', "%{$this->search}%")
                ->orWhere('base_distance', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%")
                ->orWhereHas('vehicleCategory', function ($query) {
                    $query->where('name', 'like', "%{$this->search}%");
                });
        }
        return $vehicle_type
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.vehicle-type-list')->with(['vehicleTypes' => $this->filter()]);
    }
}
