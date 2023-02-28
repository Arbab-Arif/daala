<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleTypeReportExportResource extends JsonResource
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
            $this->resource->vehicles->count(),
            $this->resource->vehicleCategory->name,
            $this->resource->name,
            $this->resource->vehicles->pluck('vehicle_no')->implode(','),
            $this->resource->vehicles->pluck('license_no')->implode(','),
            $this->resource->revenue
        ];

    }
}
