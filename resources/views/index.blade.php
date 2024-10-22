{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaflet Map with Locate Control</title>

    <!-- Leaflet CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Locate Control CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.locatecontrol@0.78.0/dist/L.Control.Locate.min.css" />
    <script src="https://unpkg.com/leaflet.locatecontrol@0.78.0/dist/L.Control.Locate.min.js"></script>

    <style>
        #map {
            height: 500px;
            width: 100%;
            border: 2px solid black;
        }
    </style>
</head>
<body>
    <h1>Leaflet Map with Locate Control</h1>
    <div id="map"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ensure Leaflet has been loaded correctly
            if (typeof L === 'undefined') {
                console.error('Leaflet failed to load.');
                return;
            }

            // Initialize the map and set it to Kathmandu, Nepal
            var map = L.map('map').setView([27.7172, 85.3240], 13);

            // Load the OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add the Locate Control to the map
            L.control.locate({
                position: 'topright',
                strings: {
                    title: "Show me where I am"  // Custom tooltip text
                },
                drawCircle: true,  // Optional: show a circle around the location
                keepCurrentZoomLevel: true
            }).addTo(map);

            // Optional: Add a marker with popup
            L.marker([27.7172, 85.3240]).addTo(map)
                .bindPopup('Kathmandu, Nepal')
                .openPopup();
        });
    </script>
</body>
</html> --}}

@extends('layouts.app')

@section('content')


<div class="group cursor-pointer">
    <div class="overflow-hidden rounded-md bg-gray-100 transition-all hover:scale-105 dark:bg-gray-800">
        {{-- Thumbnail Image with Link --}}
        <a class="relative block aspect-video" href="{{ url('/post/architectural-engineering-wonders-of-the-modern-era-for-your-inspiration') }}">
            <img alt="Thumbnail" class="object-cover transition-all" src="{{ asset('path-to-image.png') }}" style="position: absolute; height: 20%; width: 20%; inset: 0px; color: transparent;">
        </a>
    </div>

    {{-- Category and Post Title --}}
    <div class="">
        <div class="flex gap-3">
            <a href="{{ url('/category/technology') }}">
                <span class="inline-block text-xs font-medium tracking-wider uppercase mt-5 text-blue-600">
                    Technology
                </span>
            </a>
        </div>

        <h2 class="text-lg font-semibold leading-snug tracking-tight mt-2 dark:text-white">
            <a href="{{ url('/post/architectural-engineering-wonders-of-the-modern-era-for-your-inspiration') }}">
                <span class="bg-gradient-to-r from-green-200 to-green-100 bg-[length:0px_10px] bg-left-bottom bg-no-repeat transition-[background-size] duration-500 hover:bg-[length:100%_3px] group-hover:bg-[length:100%_10px] dark:from-purple-800 dark:to-purple-900">
                    Architectural Engineering Wonders of the Modern Era for Your Inspiration
                </span>
            </a>
        </h2>

        {{-- Author and Post Date --}}
        <span class="truncate text-sm">Mario Sanchez</span>
        <span class="text-xs text-gray-300 dark:text-gray-600">•</span>
        <time class="truncate text-sm" datetime="2022-10-21T15:48:00.000Z">October 21, 2022</time>
    </div>
</div>
@endsection
