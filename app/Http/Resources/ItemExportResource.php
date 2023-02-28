<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemExportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $data = json_decode($this->resource->sizeChart);


        return [
            $this->resource->id,
            $this->resource->name,
            $this->resource->category->name,
            $this->resource->unit,
            $this->resource->description,
            $data[0]->label
        ];


//        dd($item->sizeChart());
//        $itemWithSizeChart = $item->sizeChart()

    }
}
