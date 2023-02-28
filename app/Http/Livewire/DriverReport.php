<?php

namespace App\Http\Livewire;

use App\Exports\DriverReportExport;
use App\Http\Resources\DriverReportExportResource;
use App\Models\Driver;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class DriverReport extends Component
{

    use WithPagination;

    public $fromDate = null;
    public $toDate = null;
    public $driverId = null;
    public $status = null;
    public $search = '';

    public function driverReportExcel()
    {
        $data = $this->search();
        return Excel::download(new DriverReportExport(DriverReportExportResource::collection($data)), 'driver-report.xlsx');
    }

    public function search($withPaginate = true)
    {
        $driver = Driver::with('userRequest');

        /*if ((is_null($this->fromDate) ||
                is_null($this->toDate)) &&
            is_null($this->driverId) &&
            is_null($this->status)) {
            return collect([]);
        }*/

        if ($this->search) {
            $driver = $driver
                ->orWhere('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
                ->orWhere('phone', 'like', "%{$this->search}%")
                ->orWhere('cnic', 'like', "%{$this->search}%")
                ->orWhere('postal_code', 'like', "%{$this->search}%")
                ->orWhereHas('country', function ($query) {
                    $query->where('title', 'like', "%{$this->search}%");
                })
                ->orWhereHas('city', function ($query) {
                    $query->where('title', 'like', "%{$this->search}%");
                })
                ->orWhereHas('vehicle', function ($query) {
                    $query->whereHas('vehicle_type', function ($q) {
                        $q->where('name', 'like', "%{$this->search}%");
                    });
                })
                ->orWhereHas('vehicle', function ($query) {
                    $query->Where('vehicle_no', 'like', "%{$this->search}%");

                })
                ->orWhereHas('vehicle', function ($query) {
                    $query->Where('vehicle_no', 'like', "%{$this->search}%");

                });

        }
        if ($this->fromDate && $this->toDate) {
            $driver = $driver->whereBetween(
                'created_at',
                [
                    (new Carbon($this->fromDate))->subDay(),
                    (new Carbon($this->toDate))->addDay()
                ]
            );
        }

        if ($this->driverId) {
            $driver = $driver
                ->where('id', 'like', "%{$this->driverId}%");
        }

        if ($this->status) {
            $driver = $driver
                ->whereHas('userRequest', function ($query) {
                    $query->where('status', 'like', "%{$this->status}%");
                });
        }

        if (!$withPaginate) return $driver->orderBy('id', 'desc')->get();

        return $driver
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.driver-report')
            ->with([
                'drivers' => Driver::all(),
                'reports' => $this->search()
            ]);
    }

}
