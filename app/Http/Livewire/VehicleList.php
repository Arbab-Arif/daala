<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;
use Livewire\WithPagination;

class VehicleList extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $vehicleIds = [];
    public $search = '';

    protected $listeners = [
        'vehicleDeleted' => 'deleteVehicle',
        'statusUpdated' => 'updateStatusVehicle',
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

    public function deleteVehicle($id)
    {
        Vehicle::find($id)->delete();
    }

    public function updateStatusVehicle(Vehicle $vehicle)
    {
        $vehicle->update([
            'status' => !$vehicle->status
        ]);
    }

    protected function filter()
    {
         $vehicle = Vehicle::query();

        if ($this->search) {
             $vehicle = $vehicle
                ->where('vehicle_name', 'like', "%{$this->search}%");
        }
        return $vehicle
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.vehicle-list')->with(['vehicles' => $this->filter()]);
    }

}
