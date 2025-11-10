<?php

/**
 * Developed by: Valeria Cardona
 */

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
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
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $this->route('id'),
            'phone'    => 'nullable|string|max:10',
            'address'  => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'role'     => 'in:Admin,Buyer,Veterinarian',
        ];
    }
}
