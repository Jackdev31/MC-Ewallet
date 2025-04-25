<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => [
                'required',
                'email',
                Rule::unique('users','email')->ignore($this->route('user')->id),
            ],
            'password' => ['nullable', 'string', 'confirmed', 'min:8'],
            'roles'    => ['sometimes', 'array'],
            'roles.*'  => ['exists:roles,id'],
        ];
    }
}
