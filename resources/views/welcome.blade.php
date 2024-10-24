@extends('layouts.landing_app')
@section('content')
    <!-- Featured Events Section -->
    <section class="container mx-auto py-8">
        <h2 class="text-2xl font-bold mb-4">Featured Events</h2>
        <div class="grid grid-cols-3 gap-4">
            <!-- Event Card -->
            <div class="bg-white shadow-md p-4 rounded-lg">
                <img src="https://via.placeholder.com/300x150" alt="Event" class="rounded-t-lg">
                <h3 class="mt-4 text-lg font-semibold">Event Title</h3>
                <p class="text-gray-600">Event Description</p>
            </div>
            <div class="bg-white shadow-md p-4 rounded-lg">
                <img src="https://via.placeholder.com/300x150" alt="Event" class="rounded-t-lg">
                <h3 class="mt-4 text-lg font-semibold">Event Title</h3>
                <p class="text-gray-600">Event Description</p>
            </div>
            <div class="bg-white shadow-md p-4 rounded-lg">
                <img src="https://via.placeholder.com/300x150" alt="Event" class="rounded-t-lg">
                <h3 class="mt-4 text-lg font-semibold">Event Title</h3>
                <p class="text-gray-600">Event Description</p>
            </div>
        </div>
    </section>

    <!-- Browse by Category Section -->
    <section class="bg-gray-100 py-12">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-6">Browse by Category</h2>
            <div class="grid grid-cols-4 gap-6">
                <!-- Category Card -->
                <div class="bg-white p-4 rounded-lg text-center shadow-md">
                    <img src="https://via.placeholder.com/80x80" alt="Category" class="mx-auto h-16">
                    <h3 class="mt-4 text-lg font-bold">Others</h3>
                    <p class="text-gray-500">27+ Events</p>
                </div>
                <div class="bg-white p-4 rounded-lg text-center shadow-md">
                    <img src="https://via.placeholder.com/80x80" alt="Category" class="mx-auto h-16">
                    <h3 class="mt-4 text-lg font-bold">Voting</h3>
                    <p class="text-gray-500">13+ Events</p>
                </div>
                <div class="bg-white p-4 rounded-lg text-center shadow-md">
                    <img src="https://via.placeholder.com/80x80" alt="Category" class="mx-auto h-16">
                    <h3 class="mt-4 text-lg font-bold">Art & Theater</h3>
                    <p class="text-gray-500">12+ Events</p>
                </div>
                <div class="bg-white p-4 rounded-lg text-center shadow-md">
                    <img src="https://via.placeholder.com/80x80" alt="Category" class="mx-auto h-16">
                    <h3 class="mt-4 text-lg font-bold">Exhibition</h3>
                    <p class="text-gray-500">10+ Events</p>
                </div>
            </div>
        </div>
    </section>
    @endsection

