{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="pt-6 px-4">
    <div class="w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
        <!-- First Div (Latest Ticket Transactions) -->
        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-blue-900 mb-2">Latest Ticket Transactions</h3>
                    <span class="text-base font-normal text-gray-500">This is a list of latest ticket transactions</span>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ route('event.transaction') }}" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View all</a>
                </div>
            </div>

            <div class="flex flex-col mt-8">
                <div class="overflow-x-auto rounded-lg">
                    <div class="align-middle inline-block min-w-full">
                        <div class="shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Event
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Quantity
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @for ($i = 0; $i < min(5, count($transactions)); $i++)
                                    <tr class="{{ $i % 2 == 1 ? 'bg-gray-50' : '' }}">
                                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                            {{ $transactions[$i]->ticketTypes->event->event_name }}
                                        </td>
                                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                            {{ $transactions[$i]->quantity }}
                                        </td>
                                        <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                            Rs. {{ number_format($transactions[$i]->total) }}
                                        </td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Div (Recent Added Events) -->
        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 xl:col-span-2 2xl:col-span-2">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-blue-900 mb-2">Recent Added Events</h3>
                    <span class="text-base font-normal text-gray-500">This is a list of latest added events</span>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ url('vendor/events') }}" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View all</a>
                </div>
            </div>

            <div class="flex flex-col mt-8">
                <div class="overflow-x-auto rounded-lg">
                    <div class="align-middle inline-block min-w-full">
                        <div class="shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Event ID
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Event Name
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Event Type
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @for ($i = 0; $i < min(5, $events->count()); $i++)
                                        <tr class="{{ $i % 2 == 1 ? 'bg-gray-50' : '' }}">
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                {{ $events[$i]->id }}
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                {{ $events[$i]->event_name }}
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                {{ $events[$i]->event_type }}
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                {{ \Carbon\Carbon::parse($events[$i]->date)->format('l, F j, Y') }}
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                @php
                                                    // Assign the color based on event_type
                                                    $statusColor = '';
                                                    if($events[$i]->event_status == 'active') {
                                                        $statusColor = 'text-green-600';
                                                    } elseif($events[$i]->event_status == 'postponed') {
                                                        $statusColor = 'text-blue-500';
                                                    } elseif($events[$i]->event_status == 'cancelled') {
                                                        $statusColor = 'text-red-500';
                                                    } else {
                                                        $statusColor = 'text-gray-500';
                                                    }
                                                @endphp
                                                <span class="{{ $statusColor }}">
                                                    {{ $events[$i]->event_status }}
                                                </span>
                                            </td>


                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="mt-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900"></h3>
                    <h3 class="text-base sm:text-3xl font-normal text-gray-500">Total Sales</h3>

                </div>
                <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                    <h3 class="text-base sm:text-4xl font-normal text-gray-900">Rs.{{ number_format($totalTicketSales, 0, '.', ',') }}</h3>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold  text-gray-500">Total Events</span>

                </div>
                <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                    <h3 class="text-base sm:text-4xl  font-normal  text-gray-900"> {{$totalEvents}}</h3>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <!-- Title Text -->
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-indigo-600"></span>
                    <h3 class="text-base sm:text-3xl font-normal text-gray-700">Total Ticket Sold</h3>
                </div>
                <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                    <!-- Total Value Text -->
                    <h3 class="text-base sm:text-4xl font-normal text-gray-900">{{ $totalTicketSold }}</h3>
                    <!-- Arrow Icon -->
                    <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

    </div>


</div>
@endsection
