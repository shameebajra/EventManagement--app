@extends('layouts.landing_app')
@section('content')


<!-- Event Details Section -->
<section class="bg-blue-900 text-white py-8">
    <div class="container mx-auto flex flex-col md:flex-row items-center px-4">
      <!-- Event Image -->
      <div class="w-full md:w-1/3">
        <img src="{{asset('/images/eventPoster/'. $event->poster )}}"  alt="{{$event->event_name}}" class="rounded-lg shadow-lg h-64 md:h-72">
      </div>
      <!-- Event Info -->
      <div class="w-full md:w-2/3 mt-6 md:mt-0 md:ml-8">
        <h1 class="text-4xl font-bold">{{$event->event_name}}</h1>
        <div class="mt-4 flex items-center">
          <i class="fas fa-calendar-alt mr-2"></i>

          <span>{{ Carbon\Carbon::parse($event->date)->format('d M') }}</span>
        </div>
        <div class="mt-2 flex items-center">
          <i class="fas fa-clock mr-2"></i>
          {{-- {{$event->time}} --}}
          <span>{{ Carbon\Carbon::parse($event->time)->format('h:i A') }} Onwards</span>
        </div>
        <div class="mt-2 flex items-center">
          <i class="fas fa-map-marker-alt mr-2"></i>
          <span>{{$event->venue}}, {{$event->location}}</span>
        </div>
        <div class="mt-6 flex items-center justify-between">
          <span class="text-2xl">Rs. 1500</span>
          {{-- <a href="{{ route('events.edit', $event->id) }}" class="bg-red-500 text-white py-2 px-6 rounded-lg shadow-md hover:bg-red-700"> --}}
            <button id="bookNowBtn" class="bg-red-500 text-white py-2 px-6 rounded-lg shadow-md">Book Now</button>
        </div>
      </div>
    </div>
  </section>


  <!-- Event Details Section -->
  <section class="container mx-auto my-12 px-4">
    <h2 class="text-3xl font-bold mb-4">Event Details</h2>
    <p class="text-gray-700 leading-relaxed">
    {{$event->event_details}}
    </p>
  </section>

  <!-- Organizer and Terms Section -->
  <section class="container mx-auto my-12 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <!-- Organizer Info -->
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold">{{$event->user->name}}</h3>
        <h6 class="text-xs">{{$event->user->email}}</h6>
        <h6 class="text-xs ">{{$event->user->phone_number}}</h6>


        <p>Organizer</p>
        <img src="/image/img2.png" alt="Kuza Entertainment" class="h-16 w-16 mt-4">
      </div>
      <!-- Terms & Conditions -->
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold">Terms & Conditions</h3>
        <ul class="list-disc list-inside text-gray-700 mt-4">
         <li> {{$event->terms}}</li>

        </ul>
      </div>
    </div>
  </section>

                                                                                                                                                                                --}}



    <!-- Booking Modal (hidden by default) -->
    <div id="bookingModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
          <!-- Close Button -->
          <button id="closeModalBtn" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">&times;</button>

          <!-- Booking Form Content -->
          <h2 class="text-xl font-bold mb-4">Continue Booking</h2>
          <p class="text-gray-600 mb-4">Select a date to continue booking</p>

          <!-- Event Date and Time -->
          <div class="flex items-center justify-between bg-blue-500 text-white py-2 px-4 rounded-lg mb-4">
            <div class="font-bold">Nov09</div>
            <div>Saturday 7:00 PM–11:59 PM</div>
          </div>

          <!-- Ticket Type -->
          <div class="mb-4">
            <label for="ticketType" class="block text-gray-700 font-bold mb-2">Select Ticket Type</label>
            <div class="flex items-center justify-between bg-yellow-300 py-2 px-4 rounded-lg">
              <span>PHASE I<br>Rs. 500</span>
              <div class="flex items-center space-x-2">
                <button id="decrease" class="bg-gray-300 text-gray-700 py-1 px-2 rounded">-</button>
                <span id="ticketCount">1</span>
                <button id="increase" class="bg-gray-300 text-gray-700 py-1 px-2 rounded">+</button>
              </div>
              <button class="bg-blue-500 text-white py-1 px-2 rounded">✔</button>
            </div>
            <p class="mt-2 text-gray-600">Total price Rs. <span id="totalPrice">500</span></p>
          </div>

          <!-- User Details -->
          <div class="mb-4">
            <input type="text" class="w-full border border-gray-300 rounded py-2 px-3 mb-2" placeholder="Name">
            <input type="email" class="w-full border border-gray-300 rounded py-2 px-3 mb-2" placeholder="Email address">
          </div>

          <!-- Country and Phone Number -->
          <!-- <div class="mb-4 flex items-center space-x-2">
            <div class="w-full">
              <label for="country" class="block text-gray-700 font-bold mb-1">Country</label>
              <div class="flex items-center space-x-2">
                <img src="https://flagcdn.com/w40/np.png" alt="Nepal" class="w-6 h-6">
                <span>Nepal</span>
              </div>
            </div>
            <div class="w-full">
              <label for="phone" class="block text-gray-700 font-bold mb-1">Phone Number</label>
              <div class="flex">
                <input type="text" class="border border-gray-50 rounded-l" value="+977" disabled>
                <input type="text" class="border border-gray-300 rounded-r py-2 px-3" placeholder="Enter phone number">
              </div>
            </div>
          </div> -->

          <!-- Recaptcha Notice -->
          <p class="text-sm text-gray-600 mb-4">
            This site is protected by reCAPTCHA and the Google
            <a href="#" class="text-blue-500">Privacy Policy</a> and
            <a href="#" class="text-blue-500">Terms of Service</a> apply.
          </p>

          <!-- Action Buttons -->
          <div class="flex justify-between">
            <button id="cancelBtn" class="bg-gray-300 text-gray-700 py-2 px-4 rounded-md">Cancel</button>
            <button class="bg-blue-500 text-white py-2 px-4 rounded-md">Go to payment</button>
          </div>
        </div>
      </div>
@endsection
