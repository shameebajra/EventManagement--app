<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use FFI\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request){
        try{
        $credentials = $request->only("email","password");
        if (Auth::attempt($credentials )) {
            return redirect('/')->with('success', 'Logged in successfully!');
        } else {
            return back()->with('error', 'Invalid credentials');
        }
    }catch(Exception $e){
        return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
    }
    }
    }