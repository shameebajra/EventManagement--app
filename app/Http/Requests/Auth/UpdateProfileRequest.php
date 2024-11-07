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
            "phone_number" => "required|numeric|digits:10",
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'The company name is required.',
            'name.string' => 'The company name must be a valid string.',

            'phone_number.required' => 'The phone number is required.',
            'phone_number.numeric' => 'The phone number must be a valid number.',
            'phone_number.digits' => 'The phone number must be exactly 10 digits.',

        ];
    }
}
