<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class UserRequestList extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $subAdminIds = [];
    public $search = '';
    public $statusSearch = '';

    public function mount(Request $request)
    {
        $this->statusSearch = $request->get('status');
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

    protected function filter()
    {
        $booking = UserRequest::with('driver','user','vehicleType','dropOffs');

        if ($this->statusSearch) {
            $booking = $booking
                ->where('status', $this->statusSearch);
        }
        if ($this->search) {
            $booking = $booking
                ->where('status', 'like', "%{$this->search}%")
                ->orWhere('booking_id', 'like', "%{$this->search}%")
                ->orWhere('start_address', 'like', "%{$this->search}%")
                ->orWhere('amount', 'like', "%{$this->search}%")
                ->orWherehas('driver', function ($query) {
                    $query->where('name', 'like', "%{$this->search}%");
                })
                ->orWhereHas('user', function ($query) {
                    $query->where('name', 'like', "%{$this->search}%");
                })
                ->orWhereHas('vehicleType', function ($query) {
                    $query->where('name', 'like', "%{$this->search}%");
                });

        }
        return $booking
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.user-request-list')->with([
            'bookings' => $this->filter(),
            'labourCharges' => settings()->get('labour_charges'),
        ]);

    }

}
