<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerReportExportResource extends JsonResource
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
            optional($this->resource->user)->name ?? 'N/A',
            optional($this->resource->user)->email ?? 'N/A',
            optional($this->resource->user)->phone ?? 'N/A',
            optional($this->resource->user)->address ?? 'N/A',
            optional($this->resource->user)->postal_code ?? 'N/A',
            optional($this->resource->user)->country->title ?? 'N/A',
            optional($this->resource->user)->city->title ?? 'N/A',
            optional($this->resource->user)->area->title ?? 'N/A',
        ];

    }
}
