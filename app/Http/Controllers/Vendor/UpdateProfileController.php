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
    // public function updateProfile(UpdateProfileRequest $request) {

    //     try {
    //         $id = session("user_id");

    //         // Update user information
    //         $user = User::find($id);
    //         $user->name = $request->input('name');
    //         $user->phone_number = $request->input('phone_number');
    //         $user->update();
    //         // $user->update([
    //         //     'name' => $request->name,
    //         //     'phone_number' => $request->phone_number,
    //         // ]);

    //         // Prepare vendor data
    //         // $vendorData = [
    //         //     'user_id' => $id,
    //         //     'address' => $request->address,
    //         // ];

    //         // // Handle logo upload
    //         // if ($request->hasFile('logo')) {
    //         //     $logo = $request->file('logo');
    //         //     $extension = $logo->getClientOriginalExtension();
    //         //     $logoName = time() . '.' . $extension;
    //         //     $logo->move(public_path('/images/logo'), $logoName);

    //         //     $vendorData['logo'] = $logoName; // Add logo to vendor data
    //         // }

    //         // // Update or create the vendor record
    //         // Vendor::updateOrCreate(['user_id' => $id], $vendorData);

    //         return redirect()->back()->with('success', 'Profile updated successfully.');

    //     } catch (Exception $e) {
    //         Log::error('Profile update error', ['error' => $e->getMessage()]);
    //         return redirect()->back()->withErrors(['message' => 'An unexpected error occurred. Please try again later.']);
    //     }
    // }



    public function updateProfile(UpdateProfileRequest $request) {
        try {
            // Check if session and user retrieval is working
            $id = session("user_id");
            if (!$id) {
                return redirect()->back()->withErrors(['message' => 'User not logged in.']);
            }

            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
            ]);

            $vendorData = ['user_id' => $id, 'address' => $request->address];
            if ($request->hasFile('logo')) {
                $logoName = time() . '.' . $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->move(public_path('/images/logo'), $logoName);
                $vendorData['logo'] = $logoName;
            }

            Vendor::updateOrCreate(['user_id' => $id], $vendorData);

            return redirect()->back()->alert('Profile updated successfully.');
        } catch (Exception $e) {
            Log::error('Profile update error', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['message' => 'An unexpected error occurred. Please try again later.']);
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

   public function getProfile(){
    try{
        $id= Session('user_id');
        $user = User::with('vendor')->findOrFail($id);
        return response()->json([
            'status'=>200,
            'user'=> $user,
            'vendor'=> $user->vendor,
        ]);
    }catch (Exception $e) {
        return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
    }

   }

}
