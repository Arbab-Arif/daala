<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OperationReportExportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $revenue = $this->resource->amount*15/100;
        $driverAmount = $this->resource->amount - $revenue;

        return [
            $this->resource->id,
            date('d-m-Y H:m:s', strtotime($this->resource->created_at)),
            optional($this->resource->driver)->name ?? 'N/A',
            optional($this->resource->user)->name ?? 'N/A',
            $this->resource->start_address,
            '',
            '',
            '',
            '',
            '',
            '2',
            $this->resource->status,
            $this->resource->amount,
            $driverAmount,
            '15%',
            $revenue,
        ];

    }
}
