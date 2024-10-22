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
                        <!-- Success Message -->
                      

            <h2 class="text-2xl font-bold text-gray-900">
                Sign in to platform
            </h2>
            <form class="mt-8 space-y-6" action="{{route('login')}}" method="POST">
                @csrf
                <div>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Email" value="{{old('email')}}" >
                      <!-- Error Message for Email -->
                      @error('email')
                      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
                <div>
                    <input type="password" name="password" id="password" placeholder="Password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" >
                      <!-- Error Message for Email -->
                      @error('password')
                      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
                @if(session('error'))
                <div class="alert alert-success text-red-500">
                    {{ session('error') }}
                </div>
            @endif
                
                <button type="submit" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-base px-5 py-3 w-full sm:w-auto text-center">Login to your account</button>
                <div class="text-sm font-medium text-gray-500">
                    Not registered? <a href="{{route('register.form')}}" class="text-teal-500 hover:underline">Create account</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
