@include('landing_partials.header')

<body class="bg-gray-50">

    <!-- Header / Navigation Bar -->
    @include('landing_partials.navbar')

    <!-- Hero Section / Banner -->
    @include('landing_partials.hero_section')

                @yield('content')

    <!-- Foter Bar -->
     @include('landing_partials.footer')

</body>
</html>
