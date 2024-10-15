<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="{{ config('app.authors') }}">
    <link rel="stylesheet" href="resources/css/app.css">

    {{-- Include CSS --}}
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/ui@latest/dist/tailwind-ui.min.js"></script>
    
    <title>{{ isset($page->title) ? $page->title : config('app.name') }}</title>
    <link rel="canonical" href="https://themesberg.com/product/tailwind-css/dashboard-windster">

    @if(isset($page->robots))
        <meta name="robots" content="{{ $page->robots }}">
    @endif

    {{-- Include Stylesheet --}}
    @include('partials.stylesheet')

    {{-- Include Favicons --}}
    @include('partials.favicons')

    {{-- Include Social Meta Tags --}}
    @include('partials.social')

    {{-- Include Analytics --}}
    @include('partials.analytics')

    {{-- Reset CSS for body and html --}}
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
        }
        
    </style>
</head>