<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileUpdateController extends Controller
{
    public function profileUpdate(UpdateProfileRequest $request) {
        try {

            $id = session('user_id');

            $user = User::findOrFail($id);

            // Update user data
            $user->update([
                'name' => $request->input('name'),
                'phone_number' => $request->input('phone_number'),
            ]);

            return redirect()->back()->with('success', 'Profile updated successfully.');

        } catch (Exception $e) {
            Log::error('Profile update error', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['message' => 'An unexpected error occurred. Please try again later.']);
        }
    }

    public function getProfile() {
        try {
            $id = session('user_id');
            $user = User::findOrFail($id);

            return view('auth.profileUpdate', compact('user'));
        } catch (Exception $e) {
            Log::error('Error retrieving user profile', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }
}
