<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleCategoryRequest extends FormRequest
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
            'name' => 'required',
            'app_level' => 'required',
            'image' => 'required|dimensions:max_width=154, min_width=100, max_height=104 ,min_height=56'
        ];
    }

    public function messages()
    {
        return [
            'image.dimensions' => 'Image max size 154 Width x 104 Height & min size 100 Width x 56 Height'
        ];
    }
}
