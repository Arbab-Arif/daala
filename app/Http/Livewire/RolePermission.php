<?php

namespace App\Http\Livewire;

use App\Exports\RolesExport;
use App\Http\Resources\RoleExportResource;
use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class RolePermission extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $roleIds = [];
    public $search = '';

    protected $listeners = [
        'roleDeleted' => 'deleteRole',
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

    public function rolesExport()
    {
        $data = $this->filter();
        return Excel::download(new RolesExport(RoleExportResource::collection($data)), 'roles.xlsx');
    }

    public function deleteRole($id)
    {
        Role::find($id)->delete();
    }

    protected function filter()
    {
        $role = Role::query();

        if ($this->search) {
            $role = $role
                ->where('label', 'like', "%{$this->search}%");
        }
        return $role
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.role-permission')->with(['roles' => $this->filter()]);
    }
}
