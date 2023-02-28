<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerExportResource extends JsonResource
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
            $this->resource->name,
            $this->resource->email,
            $this->resource->phone,
            $this->resource->address,
            $this->resource->postal_code,
            optional($this->resource->country)->title ?? 'N/A',
            optional($this->resource->city)->title ?? 'N/A',
            optional($this->resource->area)->title ?? 'N/A',
            $this->resource->userRequest->count(),
        ];

    }
}
