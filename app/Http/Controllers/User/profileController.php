<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Display a paginated list of users
        return view('user.profile', [
            'profiles' => User::orderBy('id', 'desc')->paginate(10),
        ]);
    }

    public function edit($id)
    {
        // Retrieve and display the user profile for editing
        $profile = User::findOrFail($id);
        return view('user.edit_profile', compact('profile'));
    }

    public function update(Request $request)
    {
        // Validate the input data
        $request->validate([
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        // Update the authenticated user's profile
        $user = Auth::user();
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->email = $request->email;

        $user->save(); // Save the updated profile
        return back()->with('success', 'User details updated successfully!');
    }
    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            // Store the uploaded image in the storage
            $imagePath = $request->file('image')->store('profile_images', 'public');

            // Update the user's image path in the database
            $user->image = $imagePath;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile image updated successfully');
    }
    public function changePassword(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check if the current password matches
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        // Update the user's password
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password changed successfully!');
    }
}
