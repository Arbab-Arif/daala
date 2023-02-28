<?php

namespace App\Http\Livewire;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class SliderList extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $vehicleIds = [];
    public $search = '';


    protected $listeners = [
        'sliderDeleted' => 'deleteSlider',
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
    public function deleteSlider($id)
    {
        Slider::find($id)->delete();
    }

    public function render()
    {
        return view('livewire.slider-list')
            ->with([
                'sliders' => Slider::query()
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage)
            ]);
    }
}
