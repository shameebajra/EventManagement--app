@extends('layouts.app')

@section('content')
  <div class="container mx-auto p-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-4">Update Profile</h3>

          <!-- Show any success messages if they exist -->
            @if(session('success'))
            <p class="text-green-500 text-lg font-bold mt-1">{{ session('success') }}</p>
            @endif

            <!-- Profile Update Form -->
            <form action="{{route('vendor.profile.update')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-6 gap-6">

                    <!-- Email -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="email" class="text-sm font-medium text-gray-900 block mb-2">Email</label>
                        <input disabled type="email" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $user->email }}">
                    </div>

                    <!-- Company Name -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="name" class="text-sm font-medium text-gray-900 block mb-2">Company Name</label>
                        <input type="text" name="name" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ old('name', $user->name) }}">
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                       @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="phone_number" class="text-sm font-medium text-gray-900 block mb-2">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ old('phone_number', $user->phone_number) }}">
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
