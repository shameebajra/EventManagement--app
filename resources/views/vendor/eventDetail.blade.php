@extends('layouts.app')
@section('content')

  <!-- Back Button -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <a href="{{ URL::previous() }}" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg">
      ← Back
    </a>
  </div>

  <div class=" py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Left Section - Event Poster -->
        <div>
          <img  src="{{asset('/images/eventPoster/'. $event->poster )}}" alt="Kuza Hip-Hop Carnival" class="rounded-lg shadow-lg">
        </div>

        <!-- Right Section - Event Info -->
        <div class="flex flex-col justify-between bg-white p-6 rounded-lg shadow-lg">
          <div>
            <h1 class="text-3xl font-bold text-blue-900">{{$event->event_name}}</h1>
            <span>{{$event->event_type}}</span>

            <div class="flex items-center text-gray-500 mt-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" stroke="currentColor" fill="none">
                <path d="M12 8V12L15 15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
              </svg>
              <span>{{$event->date}}</span>
              <span class="mx-2">|</span>
              <span>{{$event->time}} ONWARDS</span>
            </div>
            <div class="flex items-center text-gray-500 mt-2">
                <img width="18" height="18" src="https://img.icons8.com/ios/50/marker--v1.png" alt="marker--v1"/>
              <span> {{$event->venue}}, {{$event->location}}</span>
            </div>
            <div class="flex items-center text-gray-500 mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18" viewBox="0 0 16 16">
                    <path d="M 7.5 1 C 3.917969 1 1 3.917969 1 7.5 C 1 11.082031 3.917969 14 7.5 14 C 11.082031 14 14 11.082031 14 7.5 C 14 3.917969 11.082031 1 7.5 1 Z M 7.5 2 C 10.542969 2 13 4.457031 13 7.5 C 13 10.542969 10.542969 13 7.5 13 C 4.457031 13 2 10.542969 2 7.5 C 2 4.457031 4.457031 2 7.5 2 Z M 10.144531 5.148438 L 6.5 8.792969 L 4.851563 7.148438 L 4.148438 7.851563 L 6.5 10.207031 L 10.855469 5.851563 Z"></path>
                    </svg>
                <span>{{$event->event_status}}</span>
              </div>
          </div>

          <!-- Ticket Price and Button -->
          <div class="mt-6">
            <div class="flex justify-between items-center">
              <div class="text-2xl font-bold text-blue-900">Rs. 1500</div>
              <a href="#" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded-lg">Book Now</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Event Details -->
      <div class="bg-white mt-8 p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-900">Event Details</h2>
        <p class="mt-4 text-gray-700">
          {{$event->event_details}}
        </p>
     </div>

      <!-- Organizer Section -->
      <div class="bg-white mt-8 p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-900">Terms & Conditions</h2>
        <p class="mt-4 text-gray-700">{{$event->terms}}</p>
      </div>

  @endsection
