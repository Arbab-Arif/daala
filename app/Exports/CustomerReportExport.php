<?php


namespace App\Exports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerReportExport implements FromCollection
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
            'Customer Name',
            'Customer Email',
            'Contact No #',
            'Customer Address',
            'Postal Code',
            'Country',
            'City',
            'Area',
        ]);

        return $this->data;
    }
}
