<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class JobExport implements FromCollection
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public $data = '';


    public function __construct(Request $request)
    {
        $jobData = $request->only('data');
        $job = json_decode($jobData['data']);
        $this->data = collect($job->data);
//        dd($this->data);
    }

    public function collection()
    {
        $sampleArray = [
            collect([
                'S.No',
                'Date',
                'Job Id',
                'Pick Up',
                'Driver Name',
                'Customer Name',
                'Vehicle Type',
                'Number of Labour',
                'Payment of ride',
                'Status',
            ]),
        ];

        foreach($this->data as $key => $job) {

            $key + 1;
            $driver = optional($job->driver)->name ?? 'N/A';
            $customer = optional($job->user)->name ?? 'N/A';
            $date = date('Y-m-d h:m:s', strtotime($job->created_at));

            array_push($sampleArray,
                collect([
                    "{$key}",
                    "{$date}",
                    "{$job->booking_id}",
                    "{$job->start_address}",
                    "{$driver}",
                    "{$customer}",
                    "",
                    "2",
                    "{$job->amount}",
                    "{$job->status}"
                ])
            );
        }
        return collect($sampleArray);
    }

}
