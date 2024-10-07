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
        //if credentials match
        if (Auth::attempt($credentials )) {
            $user = Auth::user();
            session(['role_id' => $user->role_id]);
            switch($user->role_id){
                case 1:
                    return redirect('/')->with('success', 'Logged in successfully!');
                    case 2:
                        return redirect('/')->with('success', 'Logged in successfully!');
                        case 3:
                            return redirect('/')->with('success', 'Logged in successfully!');
                            default:
                            return redirect('/')->with('error', 'Role not recognized.');
            }

            } else {
                return back()->with('error', 'Invalid credentials');
            }
        }catch(Exception $e){
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }
    }