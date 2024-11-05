<header class="bg-white shadow-md">
    <div class="container mx-auto flex justify-between items-center py-4">
        <a href="/" class="text-xl font-bold flex items-center lg:ml-2.5">
            <span class="icon-[ion--ticket-outline]" style="width: 1em; height: 1em;"></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" d="M366.05 146a46.7 46.7 0 0 1-2.42-63.42a3.87 3.87 0 0 0-.22-5.26l-44.13-44.18a3.89 3.89 0 0 0-5.5 0l-70.34 70.34a23.6 23.6 0 0 0-5.71 9.24a23.66 23.66 0 0 1-14.95 15a23.7 23.7 0 0 0-9.25 5.71L33.14 313.78a3.89 3.89 0 0 0 0 5.5l44.13 44.13a3.87 3.87 0 0 0 5.26.22a46.69 46.69 0 0 1 65.84 65.84a3.87 3.87 0 0 0 .22 5.26l44.13 44.13a3.89 3.89 0 0 0 5.5 0l180.4-180.39a23.7 23.7 0 0 0 5.71-9.25a23.66 23.66 0 0 1 14.95-15a23.6 23.6 0 0 0 9.24-5.71l70.34-70.34a3.89 3.89 0 0 0 0-5.5l-44.13-44.13a3.87 3.87 0 0 0-5.26-.22a46.7 46.7 0 0 1-63.42-2.32Z"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="m250.5 140.44l-16.51-16.51m60.53 60.53l-11.01-11m55.03 55.03l-11-11.01m60.53 60.53l-16.51-16.51"/></svg>
            <span class="self-center whitespace-nowrap">EVENTS NP</span>
          </a>
            {{-- <form class="sm:pr-3 mb-4 sm:mb-0" action="{{route('landingpage.event.search')}}" method="GET">
                <label for="products-search" class="sr-only">Search</label>
                <div class="mt-1 relative sm:w-64 xl:w-96">
                <input type="text" name="search" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Search for events">
                </div>
            </form> --}}
        <nav>
            <ul class="flex space-x-6">
                @auth
                <li><a href="{{route('myTicket')}}" class="text-gray-700 hover:text-blue-500">My Tickets</a></li>
                @endauth
                 <li><a href="{{url('/')}}" class="text-gray-700 hover:text-blue-500">Events</a></li>
               

                <li class="flex items-center space-x-2">
                    <a href="{{url("/setlang/np")}}" class="text-gray-700 hover:text-blue-500">
                        <img width="16" alt="Flag of Federal Democratic Republic of Nepal" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Flag_of_Nepal.svg/256px-Flag_of_Nepal.svg.png?20220926151831">
                    </a>
                    <span>|</span>
                    <a href="{{url("/setlang/en")}}" class="text-gray-700 hover:text-blue-500">
                        <img width="22" alt="The flag of the United States, using RGB color values as provided by the Department of State" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Flag_of_the_United_States_%28DoS_ECA_Color_Standard%29.svg/512px-Flag_of_the_United_States_%28DoS_ECA_Color_Standard%29.svg.png?20230603000457">
                    </a>
                </li>



            </ul>
        </nav>
        <div class="flex items-center space-x-4">
            @guest
            <a href="{{ url('register/vendor') }}"class="bg-pink-500 text-white px-4 py-2 rounded-full inline-block">Create Event</a>
            <a href="{{ url('login') }}" class="bg-pink-500 text-white px-4 py-2 rounded-full inline-block">Log In</a>
            @endguest

            @auth
            <a href="#" class="text-gray-700 hover:text-blue-500 font-bold">Hello, {{Session('user_name')}}</a>
                <a href="{{ route('logout') }}" class="bg-pink-500 text-white px-4 py-2 rounded-full inline-block">Log out</a>
            @endauth

        </div>
    </div>
</header>
