<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithPagination;

class PageList extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $vehicleIds = [];
    public $search = '';

    protected $listeners = [
        'pageDeleted' => 'deletePage',
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

    public function deletePage($id)
    {
        Page::find($id)->delete();
    }

    protected function filter()
    {
        $page = Page::query();

        if ($this->search) {
            $page = $page
                ->where('title', 'like', "%{$this->search}%")
                ->orWhere('type', 'like', "%{$this->search}%");
        }
        return $page
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.page-list')->with(['pages' => $this->filter()]);
    }
}
