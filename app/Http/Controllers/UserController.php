<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function userDashboard()
    {
        return view('user.user_dashboard');
    }

    public function userLogout(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    } //End Method

    public function userLogin()
    {
        return view('user.user_login');
    }


    public function userProfile()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        // dd($adminData);
        return view('user.user_profile_view', compact('userData'));
    } //End Method


    public function userEditProfile()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('user.user_profile_edit', compact('editData'));
    } //End Method



    public function userDeleteProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        // dd($user);
        if ($user) {
            $user->delete();
            return redirect('/')->with('success', 'Your account has been successfully deleted.');
        } else {
            return redirect('/')->with('error', 'User not found.');
        }
    }

    public function userStoreProfile(Request $request)
    {

        // return $request->all();

        // Validate form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'sometimes|string|max:255',
            'email' => 'required|email|max:255',
            'number' => 'required|string|max:255',
            'address' => 'sometimes|string|max:255',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ]);


        $userId = Auth::id();
        $user = User::find($userId);

        // Update user data
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->phone = $request->input('number');
        $user->address = $request->input('address');

        // Check if photo is uploaded
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = Str::random(20) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('upload/photo'), $photoName);
            $user->photo = $photoName;
        }


        $user->save();


        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
