<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255', // The product name should be required, string, and max 255 chars
            'price' => 'required|numeric|min:0', // Price must be numeric and cannot be negative
            'quantity' => 'required|integer|min:0', // Quantity must be an integer and cannot be negative
            'product_category_id' => 'nullable|exists:product_categories,id', // Optional category, but if provided, must exist in the product_categories table
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // The image must be an image file, with specific types, and max 2MB
            'description' => 'nullable|string', // Description is optional and must be a string
        ];
    }
}
