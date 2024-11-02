<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            "logo"=>"file|mimes:jpg, png,jpeg,gif|max:10240",
            "address"=>"required|string|max:255",
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a valid string.',

            'email.required' => 'The email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use.',

            'phone_number.required' => 'The phone number is required.',
            'phone_number.numeric' => 'The phone number must be a valid number.',
            'phone_number.digits' => 'The phone number must be exactly 10 digits.',

            'logo.required' => 'A logo is required.',
            'logo.file' => 'The logo must be a file.',
            'logo.mimes' => 'The logo must be a file of type: jpg, jpeg, png, gif.',
            'logo.max' => 'The logo may not be greater than 10MB.',

            'address.required' => 'The address is required.',
            'address.string' => 'The address must be a string.',
            'address.max' => 'The address may not be greater than 255 characters.',
        ];
    }
}
