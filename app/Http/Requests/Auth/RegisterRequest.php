<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "name"=>"required|string",
            "email" => "required|email|unique:users,email",
            "phone_number" => "required|numeric|digits:10", 
            "password" => "required|string|min:6|max:15",
            "confirm_password" => "required|string|min:6|max:15|same:password",

        ];
        
    }
    public function messages(): array
    {
        return [
            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a valid string.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'phone_number.required' => 'The phone number is required.',
            'phone_number.numeric' => 'The phone number must be a valid number.', 
            'phone_number.digits' => 'The phone number must be exactly 10 digits.',
            'password.required' => 'A password is required.',
            'password.string' => 'The password must be a valid string.',
            'password.min' => 'The password must be at least 6 characters long.',
            'password.max' => 'The password cannot exceed 15 characters.',
            'confirm_password.required' => 'Please confirm your password.',
            'confirm_password.string' => 'The confirmation password must be a valid string.',
            'confirm_password.min' => 'The confirmation password must be at least 6 characters long.',
            'confirm_password.max' => 'The confirmation password cannot exceed 15 characters.',
            'confirm_password.same' => 'The confirmation password must match the password.',
        ];
    }
}
