<aside id="sidebar" class="fixed hidden z-20 h-full top-0 left-0 pt-16 lg:flex flex-shrink-0 flex-col w-64 transition-width duration-75" aria-label="Sidebar">
    <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
        <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 bg-white divide-y space-y-1">
                <ul class="space-y-2 pb-2">
                    @if(session("role_id") == 2)
                        <li>
                            <a href="{{ url('vendor/dashboard') }}" class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group {{ request()->is('vendor/dashboard') ? 'bg-gray-100' : '' }}">
                                <svg class="w-6 h-6 text-gray-500 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                                </svg>
                                <span class="ml-3">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('vendor/add/events') }}" class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group {{ request()->is('vendor/add/events') ? 'bg-gray-100' : '' }}">
                                <svg class="w-6 h-6 text-gray-500 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                                <span class="ml-3 flex-1 whitespace-nowrap">Add Event</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('vendor/events') }}" class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('vendor/events') ? 'bg-gray-100' : '' }}">
                                <svg class="w-6 h-6 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-3 flex-1 whitespace-nowrap">Events</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('event.transaction') }}" class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('vendor/transaction') ? 'bg-gray-100' : '' }}">
                                <svg class="w-6 h-6 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                                <span class="ml-3 flex-1 whitespace-nowrap">Transaction</span>
                            </a>
                        </li>
                    @elseif(session("role_id") == 1)
                        <li>
                            <a href="{{ url('superadmin/dashboard') }}" class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group {{ request()->is('superadmin/dashboard') ? 'bg-gray-100' : '' }}">
                                <svg class="w-6 h-6 text-gray-500 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                                </svg>
                                <span class="ml-3">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('superadmin/events') }}" class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group {{ request()->is('superadmin/events') ? 'bg-gray-100' : '' }}">
                                <svg class="w-6 h-6 text-gray-500 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                                <span class="ml-3 flex-1 whitespace-nowrap">Events</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('superadmin/users') }}" class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group {{ request()->is('superadmin/users') ? 'bg-gray-100' : '' }}">
                                <svg class="w-6 h-6 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-3 flex-1 whitespace-nowrap">Users</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</aside>
