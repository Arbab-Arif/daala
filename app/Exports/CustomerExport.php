<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerExport implements FromCollection
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
            'Date',
            'Name',
            'Email',
            'Mobile',
            'Address',
            'Postal Code',
            'Country',
            'City',
            'Area',
            'Rides',
        ]);

        return $this->data;
    }

}
