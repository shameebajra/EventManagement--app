<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ChangePasswordRequest $request)
    {
        // Check if the current password is correct
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Begin a transaction
        DB::beginTransaction();

        try {
            // Get the authenticated user
            $user = Auth::user();

            // Update the user's password
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            // Commit the transaction
            DB::commit();

            // Return success message
            return redirect()->back()->with('success', 'Password successfully updated.');

        } catch (\Exception $e) {
            // Rollback the transaction if an error occurs
            DB::rollBack();

            // Return an error message
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }
}
