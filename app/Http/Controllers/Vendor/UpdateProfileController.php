<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Models\User;
use App\Models\Vendor;
use Exception;
  use Illuminate\Support\Facades\Session;

class UpdateProfileController extends Controller
{
    public function update(UpdateProfileRequest $request) {
        try{
            $id= session("user_id");
            Vendor::create([
                'user_id'=> $id,
                'logo'=>$request->logo,
                'address'=>$request->address,
            ]);
        }catch(Exception $e)
        {
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }

    public function getUser() {
        try {
            $user = User::where('id', Session::get("user_id"))->first();
            if ($user) {
                return view('vendor.updateProfile', ['user' => $user]);
            } else {
                return redirect()->back()->withErrors(['error' => 'User not found.']);
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }

}
