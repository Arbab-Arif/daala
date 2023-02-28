<?php

namespace App\Http\Livewire;

use App\Exports\CustomerReportExport;
use App\Http\Resources\CustomerReportExportResource;
use App\Models\User;
use App\Models\UserRequest;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class CustomerReport extends Component
{
    use WithPagination;

    public $fromDate = null;
    public $toDate = null;
    public $userId = null;
    public $status = null;
    public $search = '';

    public function customerReportExcel()
    {
        $data = $this->search();
        return Excel::download(new CustomerReportExport(CustomerReportExportResource::collection($data)), 'customer-report.xlsx');
    }

    public function search($withPaginate = true)
    {
        $customer = UserRequest::with('user', 'driver', 'vehicleType', 'dropOffs');

        /*if ((is_null($this->fromDate) ||
                is_null($this->toDate)) &&
            is_null($this->userId) &&
            is_null($this->status)) {
            return collect([]);
        }*/

        if ($this->search) {
            $customer = $customer
                ->whereHas('user', function ($query) {
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                        ->orWhere('phone', 'like', "%{$this->search}%")
                        ->orWhere('address', 'like', "%{$this->search}%")
                        ->orWhere('postal_code', 'like', "%{$this->search}%");

                })
                ->orWhereHas('user', function ($query) {
                    $query->whereHas('country', function ($q) {
                        $q->where('title', 'like', "%{$this->search}%");
                    });
                })
                ->orWhereHas('user', function ($query) {
                    $query->whereHas('city', function ($q) {
                        $q->where('title', 'like', "%{$this->search}%");
                    });
                });
            /* ->orWhereHas('user', function ($query) {
                 $query->whereHas('cityArea', function ($q) {
                     $q->where('title', 'like', "%{$this->search}%");
                 });
             });*/
        }
        if ($this->fromDate && $this->toDate) {

            $customer = $customer->whereBetween(
                'created_at',
                [
                    (new Carbon($this->fromDate))->subDay(),
                    (new Carbon($this->toDate))->addDay()
                ]
            );
        }

        if ($this->status) {
            $customer = $customer
                ->where('status', 'like', "%{$this->status}%");
        }

        if ($this->userId) {
            $customer = $customer
                ->whereHas('user', function ($query) {
                    $query->where('user_id', 'like', "%{$this->userId}%");
                });
        }

        if (!$withPaginate) return $customer->orderBy('id', 'desc')->get();

        return $customer
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.customer-report')
            ->with([
                'users'   => User::all(),
                'reports' => $this->search()
            ]);
    }

}
