<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            "old_password"=> "required",
            "new_password" => "required|string|min:6|max:15",
            "confirm_password" => "required|same:password",
        ];
    }
    public function messages(): array
    {
        return [
            'old_password.required' => 'Old password is required.',

            'new_password.required' => 'A password is required.',
            'new_password.string' => 'The password must be a valid string.',
            'new_password.min' => 'The password must be at least 6 characters long.',
            'new_password.max' => 'The password cannot exceed 15 characters.',

            'confirm_password.required' => 'Please confirm your password.',
            'confirm_password.same' => 'The confirmation password must match the password.',
        ];
    }
}
