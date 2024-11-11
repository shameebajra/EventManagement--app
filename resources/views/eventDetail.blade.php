@extends('layouts.landing_app')
@section('content')


<!-- Event Details Section -->
<section class="bg-blue-900 text-white py-8">
    <div class="container mx-auto flex flex-col md:flex-row items-start px-4">
        <!-- Event Image -->
        <div class="w-full md:w-1/3">
            <img src="{{ asset('/images/eventPoster/'. $event->poster ) }}" alt="{{ $event->event_name }}" class="rounded-lg shadow-lg h-64 md:h-72">
        </div>

        <!-- Event Info and Ticket Types -->
        <div class="w-full md:w-2/3 mt-6 md:mt-0 md:ml-8">
            <h1 class="text-4xl font-bold">{{ $event->event_name }}</h1>
            <div class="mt-4 flex items-center">
                <i class="fas fa-calendar-alt mr-2"></i>
                <span>{{ Carbon\Carbon::parse($event->date)->format('d M') }}</span>
            </div>
            <div class="mt-2 flex items-center">
                <i class="fas fa-clock mr-2"></i>
                <span>{{ Carbon\Carbon::parse($event->time)->format('h:i A') }} Onwards</span>
            </div>
            <div class="mt-2 flex items-center">
                <i class="fas fa-map-marker-alt mr-2"></i>
                <span>{{ $event->venue }}, {{ $event->location }}</span>
            </div>

            @if(Session('role_id') === 3)
            <div class="mt-6">
                <button id="bookNowBtn" value="{{ $event->id }}" class="bg-red-500 text-white py-2 px-6 rounded-lg shadow-md bookbtn">Book Now</button>
            </div>
            @elseif(Session('role_id') === 1 || Session('role_id') === 2)
            <div class="mt-6">
                <a href="#" class="bg-blue-500 text-white py-2 px-6 rounded-lg shadow-md">
                    You are not allowed to book.
                </a>
            </div>
            @else
            <div class="mt-6">
                <a href="{{ route('login') }}" class="bg-blue-500 text-white py-2 px-6 rounded-lg shadow-md">
                    Please log in to purchase tickets.
                </a>
            </div>
            @endif

           <!-- Ticket Types Table -->
            <div class="mt-8">
                <h2 class="text-3xl font-bold mb-4">Available Tickets</h2>
                <div class="overflow-x-auto rounded-lg">
                    <div class="align-middle inline-block min-w-full">
                        <div class="shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Ticket
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Price
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach($event->ticketTypes as $ticketType)
                                    <tr>
                                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                            <div class="text-2xl font-bold text-blue-900">{{ $ticketType->ticket_type }}</div>
                                        </td>
                                        <td class="p-4 whitespace-nowrap text-m font-semibold text-gray-900">
                                            @if($ticketType->quantity > 0)
                                                <!-- Smaller price display -->
                                                <div class="bg-pink-500 text-white font-bold py-1 px-3 rounded-lg text-m">Rs.{{ $ticketType->price }}</div>
                                            @else
                                                <!-- Red "Sold Out" label -->
                                                <div class="bg-red-500 text-white font-bold py-1 px-3 rounded-lg text-m">Sold Out</div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
            <h6 class="text-xs">{{$event->user->phone_number}}</h6>
            <p>Organizer</p>
        </div>

        <!-- Terms & Conditions -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold">Terms & Conditions</h3>
            <ul class="list-disc list-inside text-gray-700 mt-4">
                <li>{{$event->terms}}</li>
            </ul>
        </div>
    </div>
</section>




@auth
<!-- Booking Modal (hidden by default) -->
<div id="bookingModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
        <!-- Close Button -->
        <button id="closeModalBtn" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">&times;</button>

        <!-- Error Message (hidden by default) -->
        <div id="errorMessage" class="bg-red-500 text-white p-4 rounded-lg mb-4 hidden">
            <p id="errorText"></p>
        </div>

        <!-- Booking Form Content -->
        <h2 class="text-xl font-bold mb-4">Continue Booking</h2>
        <p class="text-gray-600 mb-4">Select a date to continue booking</p>

        <!-- Event Date and Time -->
        <div class="flex items-center justify-between bg-blue-500 text-white py-2 px-4 rounded-lg mb-4">
            <div id="eventDate" class="font-bold"></div>
            <div id="eventTime"></div>
        </div>

        <!-- Booking Form -->
        <form id="bookingForm" action="{{ route('event.book') }}" method="POST">
            @csrf

            <!-- Ticket Type -->
            <div class="mb-4">
                <label for="ticketTypeSelect" class="block text-gray-700 font-bold mb-2">Select Ticket Type</label>
                <select id="ticketTypeSelect" class="bg-yellow-300 py-2 px-4 rounded-lg w-full mb-2">
                    <!-- Options will be dynamically populated -->
                </select>
                <!-- Updated quantity input -->
                <div class="flex items-center space-x-2 mt-2">
                    <input type="number" id="ticketQuantity" class="bg-gray-100 text-gray-700 py-2 px-4 w-20 text-center rounded" value="1" min="1">
                </div>

                <p class="mt-2 text-gray-600">Total price Rs. <span id="totalPrice">0.00</span></p>
            </div>

            <!-- User Details -->
            <div class="mb-4">
                <input type="text" class="w-full border border-gray-300 rounded py-2 px-3 mb-2" placeholder="Name" name="userName" id="userName">
                <input type="email" class="w-full border border-gray-300 rounded py-2 px-3 mb-2" placeholder="Email address" id="userEmail">
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
                        <input type="text" class="border border-gray-300 rounded-r py-2 px-3" placeholder="Enter phone number" id="userPhoneNumber">
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between">
                <button id="cancelBtn" class="bg-gray-300 text-gray-700 py-2 px-4 rounded-md">Cancel</button>
                <button type="button" id="bookBtn" class="bg-blue-500 text-white py-2 px-4 rounded-md">Book</button>
            </div>
        </form>
    </div>
</div>
@endauth





@endsection
