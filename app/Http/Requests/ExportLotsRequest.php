<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportLotsRequest extends FormRequest
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
            'ids' => 'array|nullable',
            'search' => 'string|nullable',
            'sort' => 'required|string',
            'order' => 'required|in:asc,desc'
        ];
    }
}
