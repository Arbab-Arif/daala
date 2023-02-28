<?php

namespace App\Http\Livewire;

use App\Exports\UserExport;
use App\Http\Resources\UserExportResource;
use App\Models\Admin;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class SubAdmin extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $subAdminIds = [];
    public $search = '';

    protected $listeners = [
        'subAdminDeleted' => 'deleteSubAdmin',
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

    public function userExport()
    {
        $data = $this->filter();

        return Excel::download(new UserExport(UserExportResource::collection($data)), 'user.xlsx');
    }

    public function deleteSubAdmin($id)
    {
        Admin::find($id)->delete();
    }

    protected function filter()
    {
        $subAdmin = Admin::query()->where('id', '>', 2);

        if ($this->search) {
            $subAdmin = $subAdmin
                ->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
                ->orWhere('contact', 'like', "%{$this->search}%")
                ->orWhereHas('roles', function ($query) {
                    $query->where('label', 'like', "%{$this->search}%");
                });
        }
        return $subAdmin
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.sub-admin')->with(['subAdmins' => $this->filter()]);

    }
}
