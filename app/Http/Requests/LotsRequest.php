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
            'description' => 'text|nullable',
            'artist' => 'string|nullable',
            'num' => 'required|number',
            'low_estimate' => 'required',
            'high_estimate' => 'required',
            'starting_price' => 'required',
            'category_id' => 'int|nullable'
        ];
    }
}
