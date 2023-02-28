<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class SampleItemImport implements FromCollection
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $sampleArray = [
            collect([
                'Name',
                'Category Name',
                'Unit',
                'Description',
                'Size Chart Label 1',
                'Size Chart Weight 1',
                'Size Chart Width 1',
                'Size Chart Height 1',
                'Size Chart Length 1',
                'Size Chart Label 2',
                'Size Chart Weight 2',
                'Size Chart Width 2',
                'Size Chart Height 2',
                'Size Chart Length 2',
                'Size Chart Label 3',
                'Size Chart Weight 3',
                'Size Chart Width 3',
                'Size Chart Height 3',
                'Size Chart Length 3',
            ]),
        ];

        foreach (range(1, 4) as $n) {
            array_push($sampleArray,
                collect([
                    'chair',
                    'daala',
                    'Kg',
                    'good chair',
                    'Small',
                    '23',
                    '44',
                    '56',
                    '88',
                    'large',
                    '33',
                    '44',
                    '46',
                    '12',
                    'medium',
                    '24',
                    '18',
                    '78',
                    '48'
                ])
            );
        }
        return collect($sampleArray);
    }

}
