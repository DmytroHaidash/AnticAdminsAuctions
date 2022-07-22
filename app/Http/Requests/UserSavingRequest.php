<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserSavingRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string',
            'surname' => 'required|string',
            'password' => 'sometimes|required|min:6|confirmed',
            'role' => 'required|string|in:' . implode(',', User::$roles),
            'country' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'post_code' => 'required|string',
            'phone' => 'required|string',
            'comission' => 'numeric',
        ];

        if (optional(User::find($this->request->get('id')))->email !== $this->request->get('email')) {
            $rules['email'] = 'required|email|unique:users';
        }

        return $rules;
    }
}
