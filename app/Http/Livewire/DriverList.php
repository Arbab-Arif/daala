<?php

namespace App\Http\Livewire;

use App\Exports\DriverExport;
use App\Http\Resources\DriverExportResource;
use App\Models\Driver;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class DriverList extends Component
{

    use WithPagination;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $driverIds = [];
    public $search = '';
    public $vehicleTypeId = '';

    protected $listeners = [
        'driverDeleted' => 'deleteDriver',
        'statusUpdated' => 'updateStatusDriver',
    ];

    public function driverExport()
    {
        $data = $this->filter();
        return Excel::download(new DriverExport(DriverExportResource::collection($data)), 'driver.xlsx');
    }

    public function boot()
    {
        $this->vehicleTypeId = request('vehicle_type');
    }

    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function updateStatusDriver(Driver $driver)
    {
        $driver->update([
            'status' => !$driver->status
        ]);
    }

    public function deleteDriver($id)
    {
        Driver::find($id)->delete();
    }

    protected function filter()
    {
        $driver = Driver::with('city', 'country', 'area', 'vehicle');

        if ($this->vehicleTypeId) {
            $driver = $driver
                ->whereHas('vehicle', fn($query) => $query->where('vehicle_type_id', $this->vehicleTypeId));
        }

        if ($this->search) {
            $driver = $driver
                ->orWhere('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
                ->orWhere('phone', 'like', "%{$this->search}%")
                ->orWhereHas('vehicle', function ($query) {
                    $query->where('vehicle_name', 'like', "%{$this->search}%");
                });
        }

        return $driver
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.driver-list')->with(['drivers' => $this->filter()]);
    }

}
