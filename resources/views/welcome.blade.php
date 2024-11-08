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
          <div class="text-gray-600">{{ Carbon\Carbon::parse($event->date)->format('d M Y') }}</div>


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
        <!-- Event Card -->
        <div class="event-card bg-white rounded-lg shadow-lg p-5">
            <img src="{{ asset('/images/eventPoster/' . $event->poster) }}" alt="{{ $event->event_name }}" class="rounded-lg mb-4" style="width: 350px; height: 300px;">

            <div class="text-gray-800 text-xl font-bold">{{ $event->event_name }}</div>
            <div class="text-gray-600">{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</div>

            @php
                // Check if all ticket types are sold out
                $allSoldOut = $event->ticketTypes->every(fn($ticketType) => $ticketType->quantity == 0);
            @endphp

            @if ($allSoldOut)
                <button class="mt-4 bg-red-900 text-white px-4 py-2 rounded-full">
                    {{ __('welcome.soldout') }}
                </button>
            @elseif ($event->event_status === 'active')
                <form action="{{ route('landingPage.event.detail', $event->id) }}" method="GET">
                    <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700">
                        {{ __('welcome.book') }}
                    </button>
                </form>
            @elseif ($event->event_status === 'postponed')
                <div class="mt-4 text-red-500 font-bold text-xl">
                    {{ __('welcome.postponed') }}
                </div>
            @elseif ($event->event_status === 'cancelled')
                <div class="mt-4 text-red-500 font-bold text-xl">
                    {{ __('welcome.cancelled') }}
                </div>
            @endif
        </div>
    @endforeach

      </div>
    </div>

  </section>

@endsection
