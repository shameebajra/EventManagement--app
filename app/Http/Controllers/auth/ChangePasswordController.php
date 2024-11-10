<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Exception;

class ChangePasswordController extends Controller
{

    public function __invoke(ChangePasswordRequest $request)
    {
        DB::beginTransaction();

        try {
            // Get the authenticated user
            $user = \App\Models\User::find(Auth::id());

            if (!$user) {
                return redirect()->back()->withErrors(['error' => 'No authenticated user found.']);
            }

            // Check current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => 'Your current password does not match our records.',
                ]);
            }

            // Update password
            $user->password = Hash::make($request->new_password);
            $user->save();

            DB::commit();

            return redirect()->back()->with('success', 'Password successfully updated.');

        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }
}
