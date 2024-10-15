@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
  <h2 class="text-xl font-bold mb-6">Add Event</h2>
  
  <form action="" method="POST">
    @csrf

    <div class="grid grid-cols-3 gap-6">
      <!-- Event Name -->
      <div class="col-span-1">
        <label for="event_name" class="block text-sm font-medium text-gray-700">Event Name</label>
        <input type="text" name="event_name" id="event_name" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>

      <!-- Event Type -->
      <div class="col-span-1">
        <label for="event_type" class="block text-sm font-medium text-gray-700">Event Type</label>
        <input type="text" name="event_type" id="event_type" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>

      <!-- Event Details -->
      <div class="col-span-1">
        <label for="event_details" class="block text-sm font-medium text-gray-700">Event Details</label>
        <input type="text" name="event_details" id="event_details" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>

      <!-- Venue -->
      <div class="col-span-1">
        <label for="venue" class="block text-sm font-medium text-gray-700">Venue</label>
        <input type="text" name="venue" id="venue" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>

      <!-- Date -->
      <div class="col-span-1">
        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
        <input type="date" name="date" id="date" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>

      <!-- Time -->
      <div class="col-span-1">
        <label for="time" class="block text-sm font-medium text-gray-700">Time</label>
        <input type="time" name="time" id="time" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>

      <!-- Event Status -->
      <div class="col-span-1">
        <label for="status" class="block text-sm font-medium text-gray-700">Event Status</label>
        <input type="text" name="status" id="status" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>

      <div class="col-span-3">
  <label for="ticket_types" class="block text-xl font-medium text-gray-700">Tickets</label>

  <!-- Added margin (mt-4) to create space between the label and the first row -->
  <div id="ticket-types-container" class="grid grid-cols-3 gap-6 mt-4">
    <div class="ticket-type col-span-3 grid grid-cols-3 gap-6">
      <div>
        <label class="block text-sm font-medium text-gray-700">Ticket Type</label>
        <input type="text" name="ticket_types[0][name]" placeholder="Ticket Type (e.g. General Admission)" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Ticket Price</label>
        <input type="number" name="ticket_types[0][price]" placeholder="Price (e.g. 50.00)" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Quantity</label>
        <input type="number" name="ticket_types[0][quantity]" placeholder="Quantity (e.g. 100)" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>
    </div>
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
            <input id="file-upload" name="file_upload" type="file" class="sr-only">
            <span>Upload a file</span>
            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
          </div>
        </div>
      </div>

      <!-- Info -->
      <div class="col-span-2">
        <label for="info" class="block text-sm font-medium text-gray-700">Info</label>
        <textarea name="info" id="info" rows="3" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Receipt Info (optional)"></textarea>
      </div>

      <!-- Submit Button -->
      <div class="col-span-3">
        <button type="submit" class="w-full inline-flex justify-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:text-sm">
          Add Event
        </button>
      </div>
    </div>
  </form>
</div>

@endsection
