<?php

namespace App\Http\Livewire;

use App\Exports\CustomerExport;
use App\Http\Resources\CustomerExportResource;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Customer extends Component
{

    use WithPagination;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $customerIds = [];
    public $search = '';

    protected $listeners = [
        'customerDeleted' => 'deleteCustomer',
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

    public function customerExport()
    {
        $data = $this->filter();

        return Excel::download(new CustomerExport(CustomerExportResource::collection($data)), 'customer.xlsx');
    }

    public function deleteCustomer($id)
    {
        User::find($id)->delete();
    }

    protected function filter()
    {
        $customer = User::with('city','country','area');

        if ($this->search) {
            $customer = $customer
                ->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
                ->orWhere('phone', 'like', "%{$this->search}%")
                ->orWhere('address', 'like', "%{$this->search}%");
        }
        return $customer
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.customer')->with(['customers' => $this->filter()]);
    }

}
