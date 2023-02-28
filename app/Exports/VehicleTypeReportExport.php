<?php


namespace App\Exports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class VehicleTypeReportExport implements FromCollection
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
            'Total No Vehicle',
            'Vehicle Category',
            'Vehicle Type',
            'Registration No',
            'License No',
            'Revenue',
        ]);

        return $this->data;
    }
}
