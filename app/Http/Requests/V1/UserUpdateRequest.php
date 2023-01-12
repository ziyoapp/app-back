<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'patronymic' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,png,jpeg'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'],
            'nickname' => ['nullable', 'string', 'max:50', 'regex:/[A-Za-z0-9]+/', 'unique:users,nickname,' . $this->user()->id],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user()->id],
            'additional_info' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
