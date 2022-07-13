<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users',
                'country_code' => 'required',
                'mobile_number' => [
                    'required',
                    'numeric',
                    'digits_between:8,12',
                    Rule::unique('users')->where('country_code', $this->country_code)
                ],
                'password' => 'required|min:6',
                'address' => 'required'
        ];
    }
}
