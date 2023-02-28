<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'image' => 'required|dimensions:max_width=1920, min_width=1920,max_height=500 ,min_height=500',
        ];

    }

    public function messages()
    {
        return [
            'image.dimensions' => 'Image size should be 1920 Width x 500 Height'
        ];
    }
}
