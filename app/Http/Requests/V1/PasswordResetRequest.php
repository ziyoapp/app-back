<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
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
            'phone' => ['required', 'string', 'regex:/^(998)[0-9]{9}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'code' => ['required', 'integer', 'between:1111,9999'],
        ];
    }
}
