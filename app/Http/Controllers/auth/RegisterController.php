<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use FFI\Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    
    public function register(RegisterRequest $request){
    

        $roleId = null; 
        if ($request->is('register')) {
            $roleId = 2; 
        } if ($request->is('register/super-admin')) {
            $roleId = 1; // Super admin role id
        } elseif ($request->is('register/vendor')) {
            $roleId = 3; // Vendor role id
        }


        try {
            // Check if roleId is set before creating the user
            if ($roleId !== null) {
                // Create the user
                User::create([
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'password' => Hash::make($request->password),
                    'role_id' => $roleId, 
                ]);

                // Redirect based on the registration route
                if ($request->is('register/super-admin')) {
                    return redirect('/register/super-admin')->with('success', 'Registration successful! Please log in.');
                } elseif ($request->is('register/vendor')) {
                    return redirect('/register/vendor')->with('success', 'Registration successful! Please log in.');
                }elseif ($request->is('register')) {
                    return redirect('/register')->with('success', 'Registration successful! Please log in.');
                }
            } else {
                return redirect()->back()->withErrors(['error' => 'Invalid registration route.']);
            }
        } catch (QueryException $e) {
            // Catch database-related exceptions
            return redirect()->back()->withErrors(['error' => 'There was an issue with the database. Please try again later.']);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }
}
