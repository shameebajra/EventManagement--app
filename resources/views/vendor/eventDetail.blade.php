@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
      <!-- Breadcrumb -->
      {{-- <div class="text-sm text-gray-500 mb-6">
        <a href="#" class="hover:underline">Home</a> >
        <a href="#" class="hover:underline">Users</a> >
        <span class="font-bold">Profile</span>
      </div> --}}

      <!-- Profile Section -->
      <div class="flex space-x-8">
        <!-- Left Profile Card -->
        <div class="w-1/3 bg-gray-50 p-4 rounded-lg">
          <img src="{{asset('/images/eventPoster/'. $event->poster )}}" alt="Profile Image" class="rounded-full w-32 h-32 mx-auto mb-4">
          <div class="text-center">
            <h1 class="text-xl font-bold"></h1>
            <p class="text-gray-600">Frontend Developer</p>
            <p class="text-gray-500">San Francisco, USA</p>
          </div>

          <!-- Contact Info -->
          <div class="mt-6 text-sm">
            <p><strong>Email address:</strong> yourname@windster.com</p>
            <p><strong>Venue:</strong> 92 Miles Drive, Newark, NJ 07103, California, USA</p>
            <p><strong>Phone number:</strong> +00 123 456 789 / +12 345 678</p>
          </div>

          <!-- Skills -->
          <div class="mt-6">
            <h2 class="text-gray-800 font-semibold">Software Skill</h2>
            <div class="flex space-x-4 mt-2">
              <!-- Add your icons here -->
              <img src="https://via.placeholder.com/30" alt="Icon">
              <img src="https://via.placeholder.com/30" alt="Icon">
              <img src="https://via.placeholder.com/30" alt="Icon">
              <img src="https://via.placeholder.com/30" alt="Icon">
            </div>
          </div>
        </div>

        <!-- Right Info Section -->
        <div class="w-2/3 bg-gray-50 p-4 rounded-lg">
          <h2 class="text-xl font-semibold mb-4">General Information</h2>

          <div class="mb-4">
            <h3 class="text-lg font-bold">About me</h3>
            <p class="text-gray-600">Dedicated, passionate, and accomplished Full Stack Developer with 9+ years of progressive experience working as an Independent Contractor for Google and developing and growing my educational social network...</p>
          </div>

          <div class="mb-4">
            <h3 class="text-lg font-bold">Education</h3>
            <p class="text-gray-600">Thomas Jeff High School, Stanford University</p>
          </div>

          <div class="mb-4">
            <h3 class="text-lg font-bold">Work History</h3>
            <p class="text-gray-600">Twitch, Google, Apple</p>
          </div>

          <div class="mb-4">
            <h3 class="text-lg font-bold">Languages</h3>
            <p class="text-gray-600">English, German, Italian, Spanish</p>
          </div>

          <div class="mb-4">
            <h3 class="text-lg font-bold">Role</h3>
            <p class="text-gray-600">Graphic Designer</p>
          </div>

          <div class="mb-4">
            <h3 class="text-lg font-bold">Join Date</h3>
            <p class="text-gray-600">12-09-2021</p>
          </div>

          <div class="mb-4">
            <h3 class="text-lg font-bold">Organization</h3>
            <p class="text-gray-600">Themesberg LLC</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
