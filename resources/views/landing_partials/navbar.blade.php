<header class="bg-white shadow-md">
    <div class="container mx-auto flex justify-between items-center py-4">
        <a href="/" class="text-xl font-bold flex items-center lg:ml-2.5">
            {{-- <img src="../../images/logo.svg" class="h-6 mr-2" alt=" Logo"> --}}
            <span class="icon-[ion--ticket-outline]" style="width: 1em; height: 1em;"></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" d="M366.05 146a46.7 46.7 0 0 1-2.42-63.42a3.87 3.87 0 0 0-.22-5.26l-44.13-44.18a3.89 3.89 0 0 0-5.5 0l-70.34 70.34a23.6 23.6 0 0 0-5.71 9.24a23.66 23.66 0 0 1-14.95 15a23.7 23.7 0 0 0-9.25 5.71L33.14 313.78a3.89 3.89 0 0 0 0 5.5l44.13 44.13a3.87 3.87 0 0 0 5.26.22a46.69 46.69 0 0 1 65.84 65.84a3.87 3.87 0 0 0 .22 5.26l44.13 44.13a3.89 3.89 0 0 0 5.5 0l180.4-180.39a23.7 23.7 0 0 0 5.71-9.25a23.66 23.66 0 0 1 14.95-15a23.6 23.6 0 0 0 9.24-5.71l70.34-70.34a3.89 3.89 0 0 0 0-5.5l-44.13-44.13a3.87 3.87 0 0 0-5.26-.22a46.7 46.7 0 0 1-63.42-2.32Z"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="m250.5 140.44l-16.51-16.51m60.53 60.53l-11.01-11m55.03 55.03l-11-11.01m60.53 60.53l-16.51-16.51"/></svg>
            <span class="self-center whitespace-nowrap">EVENTS NP</span>
          </a>
        <nav>
            <ul class="flex space-x-6">
                <li><a href="#" class="text-gray-700 hover:text-blue-500">Home</a></li>
                <li><a href="#" class="text-gray-700 hover:text-blue-500">Events</a></li>
                <li><a href="#" class="text-gray-700 hover:text-blue-500">Voting</a></li>
                <li><a href="#" class="text-gray-700 hover:text-blue-500">Contact Us</a></li>
                <li><a href="#" class="text-gray-700 hover:text-blue-500">About Us</a></li>
            </ul>
        </nav>
        <div class="flex items-center space-x-4">
            <a href="{{ url('register/vendor') }}"class="bg-pink-500 text-white px-4 py-2 rounded-full inline-block">Create Event</a>
            <a href="{{ url('login') }}" class="bg-pink-500 text-white px-4 py-2 rounded-full inline-block">Log In</a>
        </div>
    </div>
</header>
