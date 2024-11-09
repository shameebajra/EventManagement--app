@extends('layouts.app')

@section('content')
  <div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <!-- Profile Picture and Info -->
        <div class="flex flex-col items-center">
            <img src="https://via.placeholder.com/100" alt="Profile" class="rounded-full w-24 h-24 mb-4">
            <h2 class="text-lg font-semibold">{{ $user->name }}</h2>
            <p class="text-gray-500 mb-2">{{ $user->email }}</p>
            <p class="text-gray-400 text-sm">{{$user->phone_number}}</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <p class="text-green-500 text-lg font-bold mt-4 text-center">{{ session('success') }}</p>
        @endif

        <!-- Profile Update Form -->
        <form action="{{ route('profile.update') }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-6 gap-6">

                <!-- Company Name -->
                <div class="col-span-6">
                    <label for="name" class="text-sm font-medium text-gray-900 block mb-2">Company Name</label>
                    <input type="text" name="name" id="name"
                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                           value="{{ old('name', $user->name) }}">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div class="col-span-6">
                    <label for="phone_number" class="text-sm font-medium text-gray-900 block mb-2">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number"
                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                           value="{{ old('phone_number', $user->phone_number) }}">
                    @error('phone_number')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 text-center">
                <button type="submit" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Update Profile
                </button>
            </div>
        </form>


    </div>
  </div>
@endsection
