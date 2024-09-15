<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserinfoController extends Controller
{
    public function index(Request $request)
    {
        // Get the search query if present
        $search = $request->input('search');
        
        // Modify query to handle searching by first name and last name only
        $query = User::query();
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('f_name', 'LIKE', "%{$search}%")
                  ->orWhere('l_name', 'LIKE', "%{$search}%");
            });
        }

        // Order users by ID in descending order and paginate the result
        $userinfo = $query->orderBy('id', 'desc')->paginate(7);

        return view('admin.userinfo.index', [
            'userinfo' => $userinfo,
        ]);
    }

    public function edit($id)
    {
        return view('admin.userinfo.edit', [
            'userinfo' => User::findOrFail($id)
        ]);
    }
    
    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        // Find and update the user information
        $userinfo = User::findOrFail($id);
        $userinfo->f_name = $request->f_name;
        $userinfo->l_name = $request->l_name;
        $userinfo->address = $request->address;
        $userinfo->phone = $request->phone;
        $userinfo->email = $request->email;

        // Save the updated user data
        $userinfo->save();

        return redirect(route('userinfo.index'))->with('success', 'User Details Updated successfully!');
    }

    public function destroy($id)
    {
        // Find and delete the user
        $userinfo = User::findOrFail($id);
        $userinfo->delete();

        return redirect(route('userinfo.index'))->with('success', 'User Details deleted successfully!');
    }
}
