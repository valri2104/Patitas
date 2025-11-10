<?php

/**
 * Developed by: Valeria Cardona
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
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
            'product_id'    => 'required|exists:products,id',
            'qualification' => 'required|integer|between:1,5',
            'description'   => 'required|string|min:10|max:500',
        ];
    }
}
