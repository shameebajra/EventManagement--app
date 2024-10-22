@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
  <h2 class="text-xl font-bold mb-6">Edit Event</h2>

  <!-- Display Success or Error Messages -->
  @if (session('success'))
    <div id="flash-message" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
      <p>{{ session('success') }}</p>
    </div>
  @endif

  @if (session('error'))
    <div id="flash-message" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
      <p>{{ session('error') }}</p>
    </div>
  @endif

  <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Specify the HTTP method -->

    <div class="grid grid-cols-3 gap-6">
      <!-- Event Name -->
      <div class="col-span-1">
        <label for="event_name" class="block text-sm font-medium text-gray-700">Event Name</label>
        <input type="text" name="event_name" id="event_name" value="{{ old('event_name', $event->event_name) }}" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('event_name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Event Type -->
      <div class="col-span-1">
        <label for="event_type" class="block text-sm font-medium text-gray-700">Event Type</label>
        <input type="text" name="event_type" id="event_type" value="{{ old('event_type', $event->event_type) }}" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('event_type')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Venue -->
      <div class="col-span-1">
        <label for="venue" class="block text-sm font-medium text-gray-700">Venue</label>
        <input type="text" name="venue" id="venue" value="{{ old('venue', $event->venue) }}" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('venue')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Location -->
      <div class="col-span-1">
        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
        <input type="text" name="location" id="location" value="{{ old('location', $event->location) }}" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('location')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Date -->
      <div class="col-span-1">
        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
        <input type="date" name="date" id="date" value="{{ old('date', $event->date) }}" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('date')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Time -->
      <div class="col-span-1">
        <label for="time" class="block text-sm font-medium text-gray-700">Time</label>
        <input type="time" name="time" id="time" value="{{ old('time', $event->time) }}" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('time')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Event Status -->
      <div class="col-span-1">
        <label for="event_status" class="block text-sm font-medium text-gray-700">Event Status</label>
        <select name="event_status" id="event_status" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          <option value="">Select Status</option>          
          <option value="active" {{ old('event_status', $event->event_status) == 'active' ? 'selected' : '' }}>Active</option>
          <option value="postponed" {{ old('event_status', $event->event_status) == 'postponed' ? 'selected' : '' }}>Postponed</option>
          <option value="cancelled" {{ old('event_status', $event->event_status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
          <option value="inactive" {{ old('event_status', $event->event_status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select> 
        @error('event_status')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Event Details -->
      <div class="col-span-2">
        <label for="event_details" class="block text-sm font-medium text-gray-700">Event Details</label>
        <input type="text" name="event_details" id="event_details" value="{{ old('event_details', $event->event_details) }}" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('event_details')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

     <!-- Tickets Section -->
      <div class="col-span-3">
        <label for="ticket_types" class="block text-xl font-medium text-gray-700">Tickets</label>

        <div id="ticket-types-container" class="grid grid-cols-3 gap-6 mt-4">
            @foreach ($ticketTypes as $index => $ticketType)
            <div class="ticket-type col-span-3 grid grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Ticket Type</label>
                    <select name="ticket_types[{{ $index }}][ticket_type]" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      <option value="">Select Ticket Type</option>
                      <option value="general" {{ old('ticket_types.'.$index.'.ticket_type', $ticketType->ticket_type) == 'general' ? 'selected' : '' }}>General Admission</option>
                      <option value="VIP" {{ old('ticket_types.'.$index.'.ticket_type', $ticketType->ticket_type) == 'VIP' ? 'selected' : '' }}>VIP</option>
                      <option value="early_bird" {{ old('ticket_types.'.$index.'.ticket_type', $ticketType->ticket_type) == 'early_bird' ? 'selected' : '' }}>Early Bird</option>
                      <option value="student" {{ old('ticket_types.'.$index.'.ticket_type', $ticketType->ticket_type) == 'student' ? 'selected' : '' }}>Student</option>
                      <option value="group" {{ old('ticket_types.'.$index.'.ticket_type', $ticketType->ticket_type) == 'group' ? 'selected' : '' }}>Group</option>
                      <option value="family_pass" {{ old('ticket_types.'.$index.'.ticket_type', $ticketType->ticket_type) == 'family_pass' ? 'selected' : '' }}>Family Pass</option>
                      <option value="sponsorship" {{ old('ticket_types.'.$index.'.ticket_type', $ticketType->ticket_type) == 'sponsorship' ? 'selected' : '' }}>Sponsorship</option>
                  </select>
                  @error('ticket_types.'.$index.'.ticket_type')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Ticket Price</label>
                    <input type="number" name="ticket_types[{{ $index }}][price]" value="{{ old('ticket_types.'.$index.'.price', $ticketType->price) }}" placeholder="Price (e.g. 50.00)" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('ticket_types.'.$index.'.price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="ticket_types[{{ $index }}][quantity]" value="{{ old('ticket_types.'.$index.'.quantity', $ticketType->quantity) }}" placeholder="Quantity (e.g. 100)" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('ticket_types.'.$index.'.quantity')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            @endforeach
        </div>

        <!-- Add Ticket Button -->
        <button type="button" id="add-ticket-type" class="mt-4 inline-flex justify-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:text-sm">
            Add Ticket Type
        </button>
      </div>

      <!-- Poster Upload -->
      <div class="col-span-1">
        <label class="block text-sm font-medium text-gray-700">Poster</label>
        <div class="mt-1 flex justify-center p-6 border-2 border-dashed border-gray-300 rounded-md">
            <div class="space-y-1 text-center">
                <input id="poster" name="poster" type="file" class="file-input">
                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
            </div>
        </div>
        @error('poster')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Terms & Conditions -->
      <div class="col-span-2">
        <label for="terms" class="block text-sm font-medium text-gray-700">Terms & Conditions</label>
        <textarea name="terms" id="terms" rows="3" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('terms', $event->terms) }}</textarea>
        @error('terms')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Submit Button -->
      <div class="col-span-3">
        <button type="submit" class="w-full inline-flex justify-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:text-sm">
          Update Event
        </button>
      </div>
    </div>
  </form>
</div>
@endsection
