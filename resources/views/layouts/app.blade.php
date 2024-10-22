@include('partials.header')
<body class="antialiased bg-gray-50">

    {{-- Include Navbar --}}
    @include('partials.navbar-dashboard')

    <div class="flex overflow-hidden bg-white pt-16">
        
        {{-- Include Sidebar --}}
        @include('partials.sidebar')

        <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64">
            <main>
                @yield('content')
            </main>
            
           
                @include('partials.footer-dashboard')
            
        </div>

    </div>

    {{-- Include Scripts --}}
    @include('partials.scripts')
  
</body>
</html>
