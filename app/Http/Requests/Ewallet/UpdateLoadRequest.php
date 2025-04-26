<?php

namespace App\Http\Requests\Ewallet;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust authorization if needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'balance' => ['required', 'numeric', 'min:0'],
        ];
    }

    /**
     * Custom error messages (optional).
     */
    public function messages(): array
    {
        return [
            'balance.required' => 'Please enter the new balance.',
            'balance.numeric'  => 'The balance must be a valid number.',
            'balance.min'      => 'The balance cannot be negative.',
        ];
    }
}
