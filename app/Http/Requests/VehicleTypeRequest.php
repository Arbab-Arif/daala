<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                 => 'required',
            'vehicle_category_id'  => 'required',
            'width'                => 'required',
            'height'               => 'required',
            'breath'               => 'required',
            'per_km'               => 'required',
            'per_min'              => 'required',
            'base_fare'            => 'required',
            'base_waiting_time'    => 'required',
            'waiting_time_penalty' => 'required',
            'base_distance'        => 'required',
            'commission'           => 'required',
            'description'          => 'required',
            'image'                => 'required|dimensions:max_width=154, min_width=100, max_height=104 ,min_height=56',
        ];
    }

    public function messages()
    {
        return [
            'image.dimensions' => 'Image max size 154 Width x 104 Height & min size 100 Width x 56 Height',
        ];
    }
}
