<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class DriverExport implements FromCollection
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
            'Name',
            'Email',
            'Mobile',
            'Postal Code',
            'Cnic',
            'Address',
            'Country',
            'City',
            'Area',
            'Vehicle',
            'Rides',
            'Revenue',
        ]);

        return $this->data;
    }

}
