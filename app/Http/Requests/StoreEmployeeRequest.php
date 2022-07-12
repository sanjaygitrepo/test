<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
        $rules= [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:employees,email,'.@$this->employee->id,
                'address' => 'required|min:10',
                'phone' => 'required|integer|digits_between:8,15'
        ];

        if ($this->getMethod() == 'POST') {
            $rules += ['password' => 'required|min:6'];
        }

        return $rules;        
    }
}
