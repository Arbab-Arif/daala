<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class CommercialTypeExport implements FromCollection
{

    /**
     * @return \Illuminate\Support\Collection
     */

    public $data = [];

    public function __construct($data)
    {

        $this->data = $data;

    }

    public function collection()
    {
        $this->data->prepend([
            'S.No',
            'Vehicle Type Name',
            'Vehicle Category Name',
            'Base Fare',
            'Per Km',
            'Distance',
            'Width',
            'Height',
            'Length',
            'Commission',
            'Base Waiting Time',
            'Waiting Time Penalty',
            'Description',
        ]);

        return $this->data;
    }

}
