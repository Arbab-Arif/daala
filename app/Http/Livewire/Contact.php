<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\ContactUs;
use Livewire\Component;
use Livewire\WithPagination;

class Contact extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $search = '';


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
        $category = ContactUs::query();

        if ($this->search) {
            $category = $category
                ->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
                ->orWhere('contact', 'like', "%{$this->search}%")
                ->orWhere('message', 'like', "%{$this->search}%");
        }
        return $category
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.contact')->with(['contacts' => $this->filter()]);

    }
}
