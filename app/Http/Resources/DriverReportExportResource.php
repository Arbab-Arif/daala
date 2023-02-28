<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverReportExportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            $this->resource->id,
            date('d-m-Y H:m:s', strtotime($this->resource->created_at)),
            strtok($this->resource->name, ' '),
            strstr($this->resource->name, ' '),
            $this->resource->email,
            $this->resource->phone,
            $this->resource->cnic,
            $this->resource->postal_code,
            optional($this->resource->country)->title ?? 'N/A',
            optional($this->resource->city)->title ?? 'N/A',
            optional($this->resource->area)->name ?? 'N/A',
            optional($this->resource->vehicle->vehicle_type)->name ?? 'N/A',
            optional(optional(optional($this->resource->vehicle)->vehicle_type)->vehicleCategory)->name ?? 'N/A',
            optional($this->resource->vehicle)->vehicle_no ?? 'N/A',
            $this->resource->userRequest->count(),
            $this->resource->userRequest->pluck('amount')->sum(),
        ];

    }
}
