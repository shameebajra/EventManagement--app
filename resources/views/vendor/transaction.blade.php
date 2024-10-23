@extends('layouts.app')
@section('content')
<div class="flex flex-col mt-8">
    <div class="overflow-x-auto rounded-lg">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Transaction
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date & Time
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        {{-- @foreach ($transactions as $transaction) --}}
                            <tr>
                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                   <span class="font-semibold"> </span>
                                </td>
                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">

                                </td>
                                <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">

                                </td>
                            </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
