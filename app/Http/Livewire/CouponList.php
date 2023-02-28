<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Coupon;
use Livewire\Component;
use Livewire\WithPagination;

class CouponList extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $customerIds = [];
    public $search = '';

    protected $listeners = [
        'couponDeleted' => 'deleteCoupon',
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
    public function deleteCoupon($id)
    {
        Coupon::find($id)->delete();
    }
    protected function filter()
    {
        $coupon = Coupon::query();

        if ($this->search) {
            $coupon = $coupon
                ->where('title', 'like', "%{$this->search}%")
                ->orWhere('code', 'like', "%{$this->search}%")
                ->orWhere('value', 'like', "%{$this->search}%")
                ->orWhere('type', 'like', "%{$this->search}%");
        }
        return $coupon
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.coupon-list')->with(['coupons' => $this->filter()]);

    }
}
