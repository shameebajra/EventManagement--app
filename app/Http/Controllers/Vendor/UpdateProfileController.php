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
    //     try{
    //         $id= session("user_id");
    //         $vendor = new Vendor();

    //           // Handling poster upload
    //           if ($request->hasFile('logo')) {
    //             $logo = $request->file('logo');
    //             $extension = $logo->getClientOriginalExtension();
    //             $logoName = time() . '.' . $extension;
    //             $logo->move(public_path('/images/logo'), $logoName);
    //           }

    //             $vendor->create([
    //             'user_id'=> $id,
    //             'logo'=>$logoName,
    //             'address'=>$request->address,
    //         ]);
    //         return redirect()->back();
    //     }catch(Exception $e)
    //     {
    //         return redirect()->back()->withErrors(['message' => 'An unexpected error occurred. Please try again later.']);
    //     }

    // }


    public function updateProfile(UpdateProfileRequest $request) {
        try {
            $id = session("user_id");

            if (!$id) {
                return redirect()->back()->withErrors(['message' => 'User not found in session.']);
            }

            $user = User::findOrFail($id);
            Log::info('Updating user:', ['user_id' => $id, 'data' => $request->all()]);

            if (!$user->update($request->only(['name', 'email', 'phone_number']))) {
                Log::error('User update failed', ['user_id' => $id]);
                return redirect()->back()->withErrors(['message' => 'Failed to update user.']);
            }

            $vendor = Vendor::firstOrNew(['user_id' => $id]);

            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                $logo = $request->file('logo');
                $logoName = time() . '.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('/images/logo'), $logoName);
                $vendor->logo = $logoName; // Update logo if uploaded
            }

            $vendor->address = $request->address;
            if (!$vendor->save()) {
                Log::error('Vendor save failed', ['user_id' => $id, 'vendor_data' => $vendor]);
                return redirect()->back()->withErrors(['message' => 'Failed to update vendor.']);
            }

            return redirect()->back()->with('success', 'Profile updated successfully.');

        } catch (\Exception $e) {
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
