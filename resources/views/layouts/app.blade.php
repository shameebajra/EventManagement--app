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
    <!-- Scripts -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
        $(document).ready(function(){
            $(document).on('click', '.update-btn', function(){
                var user_id = $(this).data('id');
                $('#add-user-modal').modal('show');

                $.ajax({
                    type:"GET",
                    url: "/profile/update"+user_id,
                    success: function(response){
                        console.log(response);
                    }
                });
            });
        });
    </script> --}}
    @include('partials.scripts')


</body>
</html>
