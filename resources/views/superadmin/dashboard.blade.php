{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="pt-6 px-4">
    <div class="w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">$</span>
                    <h3 class="text-base font-normal text-gray-500">Sales</h3>
                </div>
                <div class="flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                 %
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <div id="main-chart"></div>
        </div>

        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Latest tickets</h3>
                    <span class="text-base font-normal text-gray-500">This is a list of latest tickets</span>
                </div>
                <div class="flex-shrink-0">
                    <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View all</a>
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
                                            Event Name
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Phone Number
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach($tickets as $ticket)
                                    <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                            {{ $ticket->ticket_id }}
                                        </td>
                                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                            {{ $ticket->phone_number }}

                                        </td>
                                        <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                            {{ $ticket->total }}

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

    <div class="mt-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900"></h3>
                </div>
                <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                  %
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
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{$vendorsCount}}</span>
                    <h3 class="text-base font-normal text-gray-500">Total Vendor Signups</h3>
                </div>
                <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                  %
                    {{-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg> --}}
                </div>


            </div>
        </div>

        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">

                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900"> {{$usersCount}}   </span>
                    <h3 class="text-base font-normal text-gray-500">Total User Signups</h3>
                </div>
                <div class="ml-5 w-0 flex items-center justify-end flex-1 text-red-500 text-base font-bold">
                   %
                    {{-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg> --}}
                </div>

            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 2xl:grid-cols-2 xl:gap-4 my-4">
        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold leading-none text-gray-900">Latest Customers</h3>
                <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View all</a>
            </div>
            <ul role="list" class="divide-y divide-gray-200">
                {{-- @foreach($latestCustomers as $customer)
                <li class="py-3 flex items-center justify-between">
                    <div class="flex items-center">
                        <img class="h-10 w-10 rounded-full mr-3" src="{{ $customer->profile_image_url }}" alt="Profile picture of {{ $customer->name }}">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $customer->name }}</p>
                            <p class="text-sm text-gray-500">{{ $customer->email }}</p>
                        </div>
                    </div>
                    <div class="text-sm font-semibold text-gray-900">${{ number_format($customer->total_spent, 2) }}</div>
                </li>
                @endforeach --}}
            </ul>
        </div>

        {{-- <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold leading-none text-gray-900">Acquisition Overview</h3>
            </div>
            <div class="mt-2">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-900">Organic Search</span>
                    <span class="text-sm font-medium text-gray-500">data here</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                    <div class="bg-green-600 h-2 rounded-full" style="width: data here%;"></div>
                </div>

                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-900">Referral</span>
                    <span class="text-sm font-medium text-gray-500"></span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                    <div class="bg-blue-600 h-2 rounded-full" style="width: %;"></div>
                </div>

                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-900">Direct</span>
                    <span class="text-sm font-medium text-gray-500"></span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                    <div class="bg-yellow-600 h-2 rounded-full" style="width: %;"></div>
                </div>

                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-900">Social</span>
                    <span class="text-sm font-medium text-gray-500"></span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                    <div class="bg-red-600 h-2 rounded-full" style="width: %;"></div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection
