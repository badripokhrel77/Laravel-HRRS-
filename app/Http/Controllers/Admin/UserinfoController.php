<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserinfoController extends Controller
{
    public function index()
    {
        return view('admin/userinfo/index', [
            'userinfo' => User::orderBy('id','desc')->paginate(10),
        ]);
    }
    public function edit($id)
    {
        return view('admin/userinfo/edit', [
            'userinfo' =>User::findOrFail($id)
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $userinfo = User::findOrFail($id);
        $userinfo->f_name = $request->f_name;
        $userinfo->l_name = $request->l_name;
        $userinfo->address = $request->address;
        $userinfo->phone = $request->phone;
        $userinfo->email = $request->email;
    
        $userinfo->update();

        return redirect(route('userinfo.index'))->with('success', 'User Details Updated successfully!');
    }
    public function destroy($id)
    {
        $userinfo = User::findOrFail($id);
       $userinfo->delete();
       return redirect(route('userinfo.index'))->with('success', 'User Details deleted successfully!');
    }
}

