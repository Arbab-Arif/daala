<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserExportResource extends JsonResource
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
            $this->resource->contact,
            $this->resource->roles->pluck('label')->implode(''),
        ];
    }
}
