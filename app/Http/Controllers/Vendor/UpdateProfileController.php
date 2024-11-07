<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Models\User;
use App\Models\Vendor;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UpdateProfileController extends Controller
{
    public function updateProfile(UpdateProfileRequest $request) {
        dd('Controller is working');
        // try {
        //     // Debugging: Check if the request is received
        //     dd($request->all());  // Dump all input data

        //     $id = session('user_id');

        //     // Debugging: Check if session is being set
        //     dd($id);  // Check if user_id is available in the session

        //     // Ensure user exists in the database
        //     $user = User::findOrFail($id);

        //     // Update user data
        //     $user->update([
        //         'name' => $request->input('name'),
        //         'phone_number' => $request->input('phone_number'),
        //     ]);

        //     return redirect()->back()->with('success', 'Profile updated successfully.');

        // } catch (Exception $e) {
        //     // Log error
        //     Log::error('Profile update error', ['error' => $e->getMessage()]);
        //     return redirect()->back()->withErrors(['message' => 'An unexpected error occurred. Please try again later.']);
        // }
    }


    public function getProfile() {
        try {
            $id = session('user_id');
            $user = User::findOrFail($id);
            return view('vendor.profileUpdate', compact('user'));
        } catch (Exception $e) {
            Log::error('Error retrieving user profile', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }
}
