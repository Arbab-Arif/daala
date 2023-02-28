<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class ItemExport implements FromCollection
{

    /**
     * @return \Illuminate\Support\Collection
     */

    public $data = [];

    public function __construct($data)
    {
        $this->data = $data;
//        dd($this->data);
    }

    public function collection()
    {
//        $this->data->prepend([
//            'S.No',
//            'Name',
//            'Category Name',
//            'Unit',
//            'Description',
//            'Size Chart Label 1',
//            'Size Chart Weight 1',
//            'Size Chart Width 1',
//            'Size Chart Height 1',
//            'Size Chart Length 1',
//            'Size Chart Label 2',
//            'Size Chart Weight 2',
//            'Size Chart Width 2',
//            'Size Chart Height 2',
//            'Size Chart Length 2',
//            'Size Chart Label 3',
//            'Size Chart Weight 3',
//            'Size Chart Width 3',
//            'Size Chart Height 3',
//            'Size Chart Length 3',
//        ]);
//
//        return $this->data;



        $sampleArray = [
            collect([
                'S.No',
                'Name',
                'Category Name',
                'Unit',
                'Description',
            ]),
        ];

        foreach ($this->data as $key => $item) {
            $key = $key + 1;

//            dd($item->sizeChart['label']);

//            $balance += $booking->amount;
//            $label = optional($item->sizeChart)->label ?? 'N/A';
//            $customer = optional($booking->customer)->name ?? 'N/A';
//            $date = date('Y-m-d h:m:s', strtotime($booking->created_at));

            array_push($sampleArray,
                collect([
                    "{$key}",
                    "{$item->name}",
                    "{$item->category->name}",
                    "{$item->unit}",
                    "{$item->description}",
//                    "{$label}",
//                    "{$item->sizeChart->weight}",
//                    "{$item->sizeChart->width}",
//                    "{$item->sizeChart->height}",
//                    "{$item->sizeChart->breath}",
                ])
            );
        }

//        array_push($sampleArray,
//            collect([
//                "",
//                "",
//                "",
//                "",
//                "Total Booking",
//                "{$this->data->count()}",
//                "Total Fare",
//                "{$balance}",
//            ])
//        );
        return collect($sampleArray);


    }

}
