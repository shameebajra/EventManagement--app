@extends('layouts.app')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
    <div class="mb-1 w-full">
        <div class="mb-4">

            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">Sold Tickets</h1>
        </div>
        <div class="block sm:flex items-center md:divide-x md:divide-gray-100">
            <form class="sm:pr-3 mb-4 sm:mb-0" action="" method="GET">
                <label for="products-search" class="sr-only">Search</label>
                <div class="mt-1 relative sm:w-64 xl:w-96">
                    <input type="text" name="query" id="products-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Search for products">
                </div>
            </form>
            <div class="flex items-center sm:justify-end w-full">

                <div class="text-white bg-green-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-2 text-center sm:ml-auto">
                    Total Sold Tickets: {{$totalSoldTickets}}
                </div>

                <div class="text-white bg-green-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-2 text-center sm:ml-auto">
                   Total Earned: Rs. {{$totalEarned}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden">
                <table class="table-fixed min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>

                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">Ticket ID </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">Ticket Type </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">Name </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">Phone Number</th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">Total</th>

                            <th scope="col" class="p-4"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($showSoldTickets as $showSoldTicket)
                        <tr class="hover:bg-gray-100">

                            <td class="p-4 text-sm font-normal text-gray-900">{{$showSoldTicket->ticket_id}}</td>
                            <td class="p-4 text-sm font-normal text-gray-900">{{$showSoldTicket->ticketTypes->ticket_type}}</td>
                            <td class="p-4 text-sm font-normal text-gray-900">{{$showSoldTicket->name}}</td>
                            <td class="p-4 text-sm font-normal text-gray-500">{{$showSoldTicket->email}}</td>
                            <td class="p-4 text-sm font-semibold text-gray-900">{{$showSoldTicket->phone_number}}</td>
                            <td class="p-4 text-sm font-semibold text-gray-900">{{$showSoldTicket->quantity}}</td>
                            <td class="p-4 text-sm font-semibold text-gray-900">{{$showSoldTicket->total}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
