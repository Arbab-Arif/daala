<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class RolesExport implements FromCollection
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
            'Role',
            'Permissions',
        ]);

        return $this->data;
    }

}
