@extends('layouts.app')
@section('content')


<div class="mx-auto flex flex-col justify-center items-center px-6 pt-8">
    <!-- Card -->
    <div class="bg-white shadow rounded-lg md:mt-0 w-full sm:max-w-screen-sm xl:p-0">
        <div class="p-6 sm:p-8 lg:p-16 space-y-8">
            <h2 class="text-2xl lg:text-3xl font-bold text-gray-900">
                Change Password
            </h2>

            @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
            @elseif(session('error'))
                <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('password.change') }}" method="POST">
                @csrf

                <div>
                    <label for="current_password" class="text-sm font-medium text-gray-900 block mb-2">Current password</label>
                    <input type="password" name="current_password" id="current_password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        value="{{ old('current_password') }}">
                    @error('current_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="new_password" class="text-sm font-medium text-gray-900 block mb-2">New password</label>
                    <input type="password" name="new_password" id="new_password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        value="{{ old('new_password') }}">
                    @error('new_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="confirm_password" class="text-sm font-medium text-gray-900 block mb-2">Confirm new password</label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                        value="{{ old('confirm_password') }}">
                    @error('confirm_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-base px-5 py-3 w-full sm:w-auto text-center">
                    Update Password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
