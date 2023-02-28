<?php

namespace App\Http\Livewire;

use App\Models\UserFeedBack;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerFeedbackList extends Component
{

    use WithPagination;

    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'customerFeedBackDeleted' => 'deleteCustomerFeedBack',
    ];

//    public function customerExport()
//    {
//        $data = $this->filter();
//
//        return Excel::download(new CustomerExport(CustomerExportResource::collection($data)), 'customer.xlsx');
//    }

    public function deleteCustomerFeedBack($id)
    {
        UserFeedBack::find($id)->delete();
    }

    protected function filter()
    {
        $customerFeedBack = UserFeedBack::with('user');

        if ($this->search) {
            $customerFeedBack = $customerFeedBack
                ->where('suggestion', 'like', "%{$this->search}%")
                ->orWhereHas('user', function ($query) {
                    $query->where('name', 'like', "%{$this->search}%");
                });
        }
        return $customerFeedBack
            ->orderBy('id','desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.customer-feedback-list')->with(['customerFeedBacks' => $this->filter()]);
    }
}
