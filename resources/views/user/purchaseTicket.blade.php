@extends('layouts.landing_app')
@section('content')

@auth
    <!-- Booking Form Section -->
    <div class="container mx-auto p-4 bg-white shadow-md rounded-lg">
        <h2 class="text-xl font-bold mb-4">Continue Booking</h2>
        <p class="text-gray-600 mb-4">Select a date to continue booking</p>

        <!-- Event Date and Time -->
        <div class="flex items-center justify-between bg-blue-500 text-white py-2 px-4 rounded-lg mb-4">
            <div id="eventDate" class="font-bold"></div>
            <div id="eventTime"></div>
        </div>

        <!-- Booking Form -->
        <form action="{{ route('event.book') }}" method="POST">
            @csrf

            <!-- Ticket Type -->
            <div class="mb-4">
                <label for="ticketTypeSelect" class="block text-gray-700 font-bold mb-2">Select Ticket Type</label>
                <select id="ticketTypeSelect" name="ticketType" class="bg-yellow-300 py-2 px-4 rounded-lg w-full mb-2">
                    <!-- Options will be dynamically populated -->
                </select>
                <div class="flex items-center space-x-2">
                    <button id="decrease" type="button" class="bg-gray-300 text-gray-700 py-1 px-2 rounded">-</button>
                    <span id="ticketCount">1</span>
                    <button id="increase" type="button" class="bg-gray-300 text-gray-700 py-1 px-2 rounded">+</button>
                </div>
                <p class="mt-2 text-gray-600">Total price Rs. <span id="totalPrice">0</span></p>
            </div>

            <!-- User Details -->
            <div class="mb-4">
                <input type="text" class="w-full border border-gray-300 rounded py-2 px-3 mb-2" placeholder="Name" name="userName" id="userName" required>
                <input type="email" class="w-full border border-gray-300 rounded py-2 px-3 mb-2" placeholder="Email address" name="userEmail" id="userEmail" required>
            </div>

            <!-- Country and Phone Number -->
            <div class="mb-4 flex items-center space-x-2">
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
                        <input type="text" class="border border-gray-300 rounded-r py-2 px-3" placeholder="Enter phone number" id="userPhoneNumber" name="userPhoneNumber" required>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between mt-4">
                <a href="#" id="cancelBtn" class="bg-gray-300 text-gray-700 py-2 px-4 rounded-md">Cancel</a>
                <button type="submit" id="bookBtn" class="bg-blue-500 text-white py-2 px-4 rounded-md">Book</button>
            </div>
        </form>
    </div>
@endauth
@endsection
