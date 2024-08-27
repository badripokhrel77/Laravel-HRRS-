<?php

namespace App\Http\Controllers\Admin;
use App\Models\RoomBook;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookedController extends Controller
{
    public function index()
    {
        return view('admin/roombook/index', [
            'roombook' => RoomBook::orderBy('id','desc')->paginate(10),
        ]);
    }
    public function destroy($id)
    {
        $roombook = RoomBook::findOrFail($id);
       $roombook->delete();
       return redirect(route('roombook.index'))->with('success', 'Booked Room deleted successfully!');
    }
}
