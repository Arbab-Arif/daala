<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverExportResource extends JsonResource
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
            $this->resource->email,
            $this->resource->phone,
            $this->resource->postal_code,
            $this->resource->cnic,
            $this->resource->address,
            optional($this->resource->country)->title ?? 'N/A',
            optional($this->resource->city)->title ?? 'N/A',
            optional($this->resource->area)->title ?? 'N/A',
            optional($this->resource->vehicle)->vehicle_name ?? 'N/A',
            $this->resource->userRequest->count(),
            $this->resource->revenue,
        ];

    }
}
