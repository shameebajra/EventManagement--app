@extends('layouts.landing_app')

@section('content')

<!-- Latest Events Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold text-center mb-8">Latest Events</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($latestEvents as $event)
        <!-- Event Card -->
        <div class="bg-white rounded-lg shadow-lg p-5">
          <img src="{{ asset('/images/eventPoster/' . $event->poster) }}" alt="{{ $event->event_name }}" class="rounded-lg mb-4">
          <div class="text-gray-800 text-xl font-bold">{{ $event->event_name }}</div>
          <div class="text-gray-600">{{ \Carbon\Carbon::parse($event->date)->format('d M') }}</div>
          <div class="text-pink-500 text-2xl font-bold">Rs. {{ number_format($event->price) }}</div>
          <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-full">Book Now</button>
        </div>
        @endforeach
      </div>
    </div>
  </section>


  <!-- Featured Events Section -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold text-center mb-8">All Events</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($events as $event)
        <!-- Event Card -->
        <div class="event-card bg-white rounded-lg shadow-lg p-5">
          <img src="{{ asset('/images/eventPoster/' . $event->poster) }}" alt="{{ $event->event_name }}" class="rounded-lg mb-4">
          <div class="text-gray-800 text-xl font-bold">{{ $event->event_name }}</div>
          <div class="text-gray-600">{{ \Carbon\Carbon::parse($event->date)->format('d M') }}</div>
          <div class="text-pink-500 text-2xl font-bold">Rs. {{ number_format($event->price) }}</div>
          <button class="mt-4 bg-pink-500 text-white px-4 py-2 rounded-full">Book Now</button>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Browse by Category Section -->
  {{-- <section class="py-16">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold text-center mb-8">Browse by Category</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($categories as $category)
        <!-- Category Card -->
        <div class="bg-gradient-to-r from-purple-400 to-red-500 text-white p-5 rounded-lg text-center">
          <img src="{{ asset('images/icons/' . $category->icon) }}" alt="{{ $category->event_name }}" class="mx-auto mb-4 w-12 h-12">
          <div class="text-lg font-bold">{{ $category->event_name }}</div>
          <div class="text-sm">{{ $category->event_count }} Events</div>
        </div>
        @endforeach
      </div>
    </div>
  </section> --}}

  <!-- Top Picks Section -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold text-center mb-8">Top Picks</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($events as $pick)
        <!-- Top Pick Card -->
        <div class="event-card bg-white rounded-lg shadow-lg p-5">
          <img src="{{ asset('images/' . $pick->image) }}" alt="{{ $pick->event_name }}" class="rounded-lg mb-4">
          <div class="text-gray-800 text-xl font-bold">{{ $pick->event_name }}</div>
          <div class="text-gray-600">{{ \Carbon\Carbon::parse($pick->date)->format('d M') }}</div>
          <div class="text-pink-500 text-2xl font-bold">Rs. {{ number_format($pick->price) }}</div>
          <button class="mt-4 bg-green-500 text-white px-4 py-2 rounded-full">Book Now</button>
        </div>
        @endforeach
      </div>
    </div>
  </section>


@endsection
