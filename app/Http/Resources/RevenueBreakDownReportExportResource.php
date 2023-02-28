<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RevenueBreakDownReportExportResource extends JsonResource
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
            formatDuration($this->resource->started_at->diffInMinutes($this->resource->finished_at)),
            optional($this->resource->vehicleType)->name ?? 'N/A',
            optional($this->resource->vehicleType)->vehicleCategory->name ?? 'N/A',
            optional($this->resource->driver)->name ?? 'N/A',
            $this->resource->distance,
            optional($this->resource->driver)->vehicle->vehicle_no ?? 'N/A',
            optional($this->resource->driver)->vehicle->license_no ?? 'N/A',
            optional($this->resource->vehicleType)->revenue ?? 'N/A'
        ];

    }
}
