<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.admin_dashboard');
    }



    public function adminLogout(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    } //End Method


    public function adminLogin()
    {
        return view('admin.admin_login');
    }



    public function adminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        // dd($adminData);
        return view('admin.admin_profile_view', compact('adminData'));
    } //End Method


    public function adminEditProfile()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit', compact('editData'));
    } //End Method



    public function adminDeleteProfile()
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

    public function adminStoreProfile(Request $request)
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




    public function index(Request $request)
    {
        $users = User::query();
        if ($request->has('search')) {
            $search = $request->search;
            $users->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%");
            });
        }

        $users = $users->paginate(10);

        return view('admin.users.index', compact('users'));
    }


    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Validate form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'sometimes|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'sometimes|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'status' => 'required|in:active,inactive',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle photo upload
        $photoName = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('upload/photo'), $photoName);
        }

        // Create new user
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status,
            'photo' => $photoName,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }



    public function update(Request $request, $id)
    {
        // Validate form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'sometimes|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'sometimes|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'status' => 'required|in:active,inactive',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the user
        $user = User::findOrFail($id);

        // Handle photo upload
        if ($request->hasFile('photo')) {

            if ($user->photo) {
                $oldPhotoPath = public_path('upload/photo/' . $user->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('upload/photo'), $photoName);
            $user->photo = $photoName;
        }

        // Update user data
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->photo) {
            File::delete(public_path('uploads/photos/' . $user->photo));
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
