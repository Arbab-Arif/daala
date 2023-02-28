<?php


namespace App\Exports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class DriverReportExport implements FromCollection
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
            'First Name',
            'Last Name',
            'Email',
            'Mobile',
            'Cnic',
            'Postal Code',
            'Country',
            'City',
            'Area',
            'Vehicle Type',
            'Vehicle Category',
            'Vehicle No',
            'Total Rides',
            'Total Amount',
        ]);

        return $this->data;
    }
}
