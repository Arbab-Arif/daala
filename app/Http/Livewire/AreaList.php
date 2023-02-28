<?php

namespace App\Http\Livewire;

use App\Models\Area;
use Livewire\Component;
use Livewire\WithPagination;

class AreaList extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $itemIds = [];
    public $search = '';

    protected $listeners = [
        'areaDeleted'  => 'areaDeleted',
        'statusUpdate' => 'statusUpdate',
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

    public function areaDeleted($id)
    {
        Area::find($id)->delete();
    }

    public function statusUpdate(Area $area)
    {
        $area->update([
            'status' => !$area->status
        ]);
    }

    protected function filter()
    {
        $area = Area::query();

        if ($this->search) {
            $area = $area
                ->where('name', 'like', "%{$this->search}%");
        }
        return $area
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.area-list')->with(['areas' => $this->filter()]);
    }
}
