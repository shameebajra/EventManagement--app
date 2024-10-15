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
    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modalToggleButtons = document.querySelectorAll('[data-modal-toggle]');
            const modals = document.querySelectorAll('.modal');
    
            modalToggleButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const targetModal = document.getElementById(button.getAttribute('data-modal-toggle'));
                    targetModal.classList.toggle('hidden'); // Show/Hide the modal
                });
            });
        });
    </script> --}}
</body>
</html>
