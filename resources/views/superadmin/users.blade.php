@extends('layouts.app')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
    <div class="mb-1 w-full">
        <div class="mb-4">

            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">All Users</h1>
        </div>
        <div class="block sm:flex items-center md:divide-x md:divide-gray-100">
            <form class="sm:pr-3 mb-4 sm:mb-0" action="{{ route('superadmin.user.search') }}" method="GET">
                @csrf
                <label for="products-search" class="sr-only">Search</label>
                <div class="mt-1 relative sm:w-64 xl:w-96">
                    <input type="text" name="search" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Search here" value="{{ isset($search) ? $search : '' }}">
                </div>
            </form>

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

                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                               Name/Organization Name
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                Email
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                Phone Number
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                Role
                            </th>

                            <th scope="col" class="p-4">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)

                        <tr class="hover:bg-gray-100">

                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                <div class="text-base font-semibold text-gray-900">{{ $user->name }}</div>
                            </td>
                            <td class="p-4 whitespace-nowrap text-base font-medium text-gray-900">{{$user->email }}</td>
                            <td class="p-4 whitespace-nowrap text-base font-medium text-gray-900">{{ $user->phone_number }}</td>
                            @if($user->role_id == 2)
                            <td class="p-4 whitespace-nowrap text-base font-medium text-blue-800">Vendor</td>
                            @else
                            <td class="p-4 whitespace-nowrap text-base font-medium text-green-600">User</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    {{ $users->links() }}
</div>



@endsection



