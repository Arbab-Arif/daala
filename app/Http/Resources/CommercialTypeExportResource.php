<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommercialTypeExportResource extends JsonResource
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
            $this->resource->name,
            $this->resource->vehicleCategory->name,
            $this->resource->base_fare,
            $this->resource->per_km,
            $this->resource->base_distance,
            $this->resource->width,
            $this->resource->height,
            $this->resource->breath,
            $this->resource->commission,
            $this->resource->base_waiting_time,
            $this->resource->waiting_time_penalty,
            $this->resource->description,
        ];

    }
}
