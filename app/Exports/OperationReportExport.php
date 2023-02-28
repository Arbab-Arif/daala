<?php


namespace App\Exports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class OperationReportExport implements FromCollection
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
            'Driver',
            'Customer',
            'Pick Up',
            'Drop Off 1',
            'Drop Off 2',
            'Drop Off 3',
            'Drop Off 4',
            'Drop Off 5',
            'No Of Labour #',
            'Job Status',
            'Job Amount',
            'Driver Amount',
            'Revenue Percentage',
            'Revenue',
        ]);

        return $this->data;
    }
}
