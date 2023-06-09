<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            #'first_name' => ['required', 'string', 'max:255'],
            #'last_name' => ['required', 'string', 'max:255'],
            #'patronymic' => ['nullable', 'string', 'max:255'],
            #'birth_date' => ['required', 'date'],
            #'gender' => ['required', 'in:male,female'],
            'phone' => ['required', 'string', 'regex:/^(998)[0-9]{9}$/'],
            #'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'code' => ['required', 'integer', 'between:1111,9999'],
            #'privacy_accept' => ['accepted']
        ];
    }
}
