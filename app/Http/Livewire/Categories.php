<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $customerIds = [];
    public $search = '';

    protected $listeners = [
        'categoryDeleted' => 'deleteCategory',
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
    public function deleteCategory($id)
    {
        Category::find($id)->delete();
    }
    protected function filter()
    {
        $category = Category::query();

        if ($this->search) {
            $category = $category
                ->where('name', 'like', "%{$this->search}%");
        }
        return $category
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.category')->with(['categories' => $this->filter()]);

    }
}
