<?php

namespace App\Http\Requests\Ewallet;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow everyone for now, you can customize this later if needed
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric', 'min:1'],
        ];
    }

    /**
     * Custom messages for validation errors (optional).
     */
    public function messages(): array
    {
        return [
            'amount.required' => 'Please enter an amount to load.',
            'amount.numeric'  => 'The amount must be a valid number.',
            'amount.min'      => 'The minimum amount to load is ₱1.',
        ];
    }
}
