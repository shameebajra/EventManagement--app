@extends('layouts.app')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
    <div class="mb-1 w-full">
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">All Events</h1>
        </div>

        <div class="block sm:flex items-center md:divide-x md:divide-gray-100">
            <form class="sm:pr-3 mb-4 sm:mb-0" action="{{ route('event.search') }}" method="GET">
                @csrf
                <label for="products-search" class="sr-only">Search</label>
                <div class="mt-1 relative sm:w-64 xl:w-96">
                    <input type="text" name="search" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Search here" value="{{ isset($search) ? $search : '' }}">
                </div>
            </form>
            <div class="flex items-center sm:justify-end w-full">
                <a href="/vendor/add/events"
                data-modal-toggle="add-product-modal"
                class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-2 text-center sm:ml-auto">
                 <svg class="-ml-1 mr-2 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                 </svg>
                 Add product
             </a>

            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4">
    @foreach ($events as $event)
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <img src="{{ asset('/images/eventPoster/' . $event->poster) }}" class="w-full h-48 object-cover" alt="poster">
        <div class="p-4">
            <h2 class="text-lg font-semibold text-gray-900">{{ $event->event_name }}</h2>
            <p class="text-sm text-gray-500">{{ $event->event_type }}</p>
            <p class="mt-2 text-base text-gray-700">{{ $event->venue }}</p>
            <p class="text-sm text-gray-500">{{ $event->location }}</p>
            <p class="text-sm text-gray-500">{{ $event->time }}</p>
            <p class="text-sm text-gray-500">{{ $event->event_status }}</p>

            <div class="mt-4 flex space-x-2">
                <!-- Detail Button -->
                <a href="{{ route('event.detail', $event->id) }}" class="bg-cyan-600 text-white rounded-lg px-4 py-2 text-sm hover:bg-cyan-700">
                    Detail
                </a>
                <a href="{{ route('event.sold.tickets', $event->id) }}" class="bg-cyan-600 text-white rounded-lg px-4 py-2 text-sm hover:bg-cyan-700">
                    Sold Tickets
                </a>


                <!-- Edit Button -->
                <a href="{{ route('events.edit', $event->id) }}" class="bg-cyan-600 text-white rounded-lg px-4 py-2 text-sm hover:bg-cyan-700">
                    Edit
                </a>

                <!-- Delete Button -->
                <form action="{{ route('events.delete', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-700 text-white rounded-lg px-4 py-2 text-sm hover:bg-red-800">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{$events->links()}}
@endsection
