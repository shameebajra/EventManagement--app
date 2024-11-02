<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
<div class="mx-auto md:h-screen flex flex-col justify-center items-center px-6 pt-8 pt:mt-0">
    <a href="" class="text-2xl font-semibold flex justify-center items-center mb-8 lg:mb-10">
        <img width="30" height="30" src="https://img.icons8.com/ios/50/ticket--v1.png" alt="ticket--v1"/>
        <span class="self-center text-2xl lg:text-3xl font-bold whitespace-nowrap">EVENTS NP</span>
    </a>
    <!-- Card -->
    <div class="bg-white shadow rounded-lg md:mt-0 w-full sm:max-w-screen-sm xl:p-0">
        <div class="p-6 sm:p-8 lg:p-16 space-y-8">
            <h2 class="text-2xl font-bold text-gray-900">
                Create Account
            </h2>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success text-green-500">
                    {{ session('success') }}
                </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ request()->is('register/super-admin') ? route('register.super-admin') : (request()->is('register/vendor') ? route('register.vendor') : route('register.user')) }}" method="POST">
                @csrf
                <div>
                    @if(request()->is('register'))
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Name" value="{{ old('name') }}">

                    <!-- Error Message for Email -->
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror


                    @elseif(request()->is('register/super-admin'))
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Company name" value="{{ old('name') }}">

                    <!-- Error Message for Email -->
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror


                    @elseif(request()->is('register/vendor'))
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Organizer name" value="{{ old('name') }}">

                    <!-- Error Message for Email -->
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror


                    @endif
                </div>


                <div>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Email" value="{{ old('email') }}">

                    <!-- Error Message for Email -->
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input type="text" name="phone_number" id="phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Phone number" value="{{ old('phone_number') }}">

                    <!-- Error Message for Phone Number -->
                    @error('phone_number')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Password">

                    <!-- Error Message for Password -->
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input type="password" name="confirm_password"" id="confirm_password"" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Re-password">
                    <!-- Error Message for Confirm Password -->
                    @error('confirm_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-base px-5 py-3 w-full sm:w-auto text-center">
                    Create account
                </button>

                <div class="text-sm font-medium text-gray-500">
                    Already have an account? <a href="{{route('login.form')}}" class="text-teal-500 hover:underline">Login here</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
