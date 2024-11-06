@extends('layouts.landing_app')

@section('content')
<!-- Hero Section-->
<section class="bg-cover bg-center text-white text-center py-24" style="background-image: url('{{ asset('images/poster.png') }}');">
        <div class="text-4xl font-bold">{{ __('welcome.hero_section') }}</div>
        <div class="text-2xl mt-4">{{ __('welcome.hero_section_subheading') }}</div>
</section>




<!-- Latest Events Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold text-center mb-8"> {{ __('welcome.latest_events') }}</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($latestEvents as $event)
        <!-- Event Card -->
        <div class="bg-white rounded-lg shadow-lg p-5">
            <img src="{{ asset('/images/eventPoster/' . $event->poster) }}" alt="{{ $event->event_name }}"  class="rounded-lg mb-4" style="width: 350px; height: 300px;">
          <div class="text-gray-800 text-xl font-bold">{{ $event->event_name }}</div>
          <div class="text-gray-600">{{ Carbon\Carbon::parse($event->date)->format('d M') }}</div>
          {{-- <div class="text-pink-500 text-2xl font-bold">Rs. {{ number_format($event->price) }}</div> --}}


            @if ($event->event_status === 'active')
                <form action="{{ route('landingPage.event.detail', $event->id) }}" method="GET">
                    <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700">
                        {{ __('welcome.book') }}
                    </button>
                </form>
                @elseif($event->event_status === 'postponed')
                <div class="mt-4 text-red-500 font-bold text-xl">
                    {{ __('welcome.postponed') }}
                </div>
            @elseif($event->event_status === 'cancelled')
                <div class="mt-4 text-red-500 font-bold text-xl">
                    {{ __('welcome.cancelled') }}
                </div>
            @endif
        </div>
        @endforeach
      </div>
    </div>
  </section>


  <!-- All Events Section -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold text-center mb-8">{{ __('welcome.all_events') }}</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($events as $event)
        @foreach($event->ticketTypes as $ticketType)
        <!-- Event Card -->
        <div class="event-card bg-white rounded-lg shadow-lg p-5">
            <img src="{{ asset('/images/eventPoster/' . $event->poster) }}" alt="{{ $event->event_name }}"  class="rounded-lg mb-4" style="width: 350px; height: 300px;">

          <div class="text-gray-800 text-xl font-bold">{{ $event->event_name }}</div>
          <div class="text-gray-600">{{ \Carbon\Carbon::parse($event->date)->format('d M') }}</div>
          {{-- <div class="text-pink-500 text-2xl font-bold">Rs. {{ number_format($event->price) }}</div> --}}
          @if($ticketType->quantity == 0)
            <button type="submit" class="mt-4 bg-red-900 text-white px-4 py-2 rounded-full">
              {{-- {{ __('welcome.soldout') }} --}}
              Sold out

            </button>

          @elseif ($event->event_status === 'active')
          <form action="{{ route('landingPage.event.detail', $event->id) }}" method="GET">
              <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700">
                {{ __('welcome.book') }}

              </button>
          </form>
          @elseif($event->event_status === 'postponed')
        <div class="mt-4 text-red-500 font-bold text-xl">
            {{ __('welcome.postponed') }}
        </div>
         @elseif($event->event_status === 'cancelled')
        <div class="mt-4 text-red-500 font-bold text-xl">
            {{ __('welcome.cancelled') }}
        </div>
        @endif
        </div>
        @endforeach
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

  {{-- <!-- Top Picks Section -->
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
          <form action="{{ route('landingPage.event.detail', $event->id) }}" method="GET">
            <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700">
                Book Now
            </button>
        </form>
        </div>
        @endforeach
      </div>
    </div>
  </section> --}}


@endsection
