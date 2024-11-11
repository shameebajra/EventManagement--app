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

       // Check the route and assign role
        $roleId = null;
        if ($request->is('register')) {
            $roleId = 3;
        } if ($request->is('register/super-admin')) {
            $roleId = 1;
        } elseif ($request->is('register/vendor')) {
            $roleId = 2;
        }


        try {
                if ($roleId !== null) {
                    //create user
                User::create([
                    'email' => $request->email,
                    'name'=> $request->name,
                    'phone_number' => $request->phone_number,
                    'password' => Hash::make($request->password),
                    'role_id' => $roleId,
                ]);

                //redirect user according to route
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
        }catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }
}
