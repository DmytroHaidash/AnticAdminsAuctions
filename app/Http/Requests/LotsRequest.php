<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LotsRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'string|nullable',
            'artist' => 'string|nullable',
            'num' => 'required|numeric',
            'low_estimate' => 'required|numeric',
            'high_estimate' => 'required|numeric',
            'starting_price' => 'required|numeric',
            'category_id' => 'numeric|nullable'
        ];
    }
}
