{{-- Preconnect to Google Fonts --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

{{-- Google Fonts --}}
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

{{-- Application CSS --}}
<link rel="stylesheet" href="{{ asset('app.css') }}">

<style>
   /* Apply blur effect when modal is open */
.blur {
    filter: blur(5px);
    transition: filter 0.3s ease-in-out;
}

/* Prevent scrolling when modal is active */
.modal-open {
    overflow: hidden;
}

</style>