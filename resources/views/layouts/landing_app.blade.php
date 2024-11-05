@include('landing_partials.header')

<body class="font-sans">

    <!-- Header / Navigation Bar -->
    @include('landing_partials.navbar')


                @yield('content')

    <!-- Foter Bar -->
     @include('landing_partials.footer')
     @include('landing_partials.script')
</body>
</html>
