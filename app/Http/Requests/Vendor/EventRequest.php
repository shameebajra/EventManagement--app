<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            "event_name"=>"required|string|max:255",
            "event_type"=>"required|string|max:255",
            "event_details"=>"required|string|max:500",
            "venue"=>"required|string|max:255",
            "location"=>"required|string|max:255",
            "date"=>"required|date|after_or_equal:today",
            "time"=> "required|date_format:H:i",
            "event_status" => "required|string|in:active,postponed,inactive,cancelled",
            "poster"=>"required|file|mimes:jpg,jpeg,png,gif|max:10240",
            "terms" => "nullable|string",

            // Ticket types validation rules
            'ticket_types.*.ticket_type' => 'required|string',
            'ticket_types.*.price' => 'required|numeric|min:0',
            'ticket_types.*.quantity' => 'required|integer|min:1', 
        ];
    }
    
    public function messages(): array
    {
        return [
            'event_name.required' => 'The event name is required.',
            'event_name.string' => 'The event name must be a string.',
            'event_name.max' => 'The event name may not be greater than 255 characters.',
        
            'event_type.required' => 'The event type is required.',
            'event_type.string' => 'The event type must be a string.',
            'event_type.max' => 'The event type may not be greater than 255 characters.',
        
            'event_details.required' => 'Event details are required.',
            'event_details.string' => 'Event details must be a string.',
            'event_details.max' => 'Event details may not be greater than 500 characters.',
        
            'venue.required' => 'The venue is required.',
            'venue.string' => 'The venue must be a string.',
            'venue.max' => 'The venue may not be greater than 255 characters.',

            'location.required' => 'The location is required.',
            'location.string' => 'The location must be a string.',
            'location.max' => 'The location may not be greater than 255 characters.',
        
            'date.required' => 'The date is required.',
            'date.date' => 'The date must be a valid date.',
            'date.after_or_equal' => 'The date must be today or a future date.',
        
            'time.required' => 'The time is required.',
            'time.date_format' => 'The time must be in the format HH:MM.',
        
            'event_status.required' => 'The event status is required.',
            'event_status.string' => 'The event status must be a string.',
            'event_status.in' => 'The event status must be one of the following: active, postponed, inactive, cancelled.',
        
            'poster.required' => 'A poster is required.',
            'poster.file' => 'The poster must be a file.',
            'poster.mimes' => 'The poster must be a file of type: jpg, jpeg, png, gif.',
            'poster.max' => 'The poster may not be greater than 10MB.',
        
            'terms.string' => 'Terms must be a valid string.',

            // Ticket type validation messages
            'ticket_types.*.ticket_type.required' => 'Each ticket type must have a type specified.',
            'ticket_types.*.price.required' => 'Each ticket must have a price.',
            'ticket_types.*.price.numeric' => 'The ticket price must be a valid number.',
            'ticket_types.*.price.min' => 'The ticket price must be at least 0.',
            'ticket_types.*.quantity.required' => 'Each ticket must have a quantity.',
            'ticket_types.*.quantity.integer' => 'The ticket quantity must be an integer.',
            'ticket_types.*.quantity.min' => 'The ticket quantity must be at least 1.',
        ];
    }
}
