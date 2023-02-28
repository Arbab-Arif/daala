<?php

namespace App\Http\Livewire;

use App\Exports\ItemExport;
use App\Exports\SampleItemImport;
use App\Http\Resources\ItemExportResource;
use App\Imports\ItemImport;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Items extends Component
{

    use WithPagination, WithFileUploads;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $itemIds = [];
    public $search = '';
    public $excelImportFile = null;


    protected $listeners = [
        'itemDeleted' => 'deleteItem',
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

    public function sampleDownload()
    {
        return Excel::download(new SampleItemImport(), 'item.xlsx');
    }

    public function itemExport()
    {
        $data = $this->filter(false);

        return Excel::download(new ItemExport($data), 'item.xlsx');
    }

    public function save()
    {
        $this->validate([
            'excelImportFile' => 'file|max:10240'
        ]);

        ini_set('max_execution_time', '-1');
        Excel::import(new ItemImport(), $this->excelImportFile);
        $this->excelImportFile = null;
    }

    public function deleteItem($id)
    {
        Item::find($id)->delete();
    }

    protected function filter($withPaginate = true)
    {
        $item = Item::with('sizeChart', 'category');

        if ($this->search) {
            $item = $item
                ->where('name', 'like', "%{$this->search}%")
                ->orWhere('unit', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%")
                ->orWhereHas('category', function ($query) {
                    $query->where('name', 'like', "%{$this->search}%");
                });
        }

        if (!$withPaginate) return $item->orderBy('id', 'asc')->get();

        return $item
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.item')->with(['items' => $this->filter()]);

    }

}
