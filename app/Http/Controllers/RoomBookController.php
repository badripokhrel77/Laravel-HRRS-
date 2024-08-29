<?php

namespace App\Http\Controllers;
use App\Models\RoomBook;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomBookController extends Controller
{
    public function book($id)
    {
        return view('frontend/room/book', [
            'room' =>Room::findOrFail($id)
        ]);
      
    }
    public function bookview()
    {
        return view('frontend.room.bookview');
    }

    public function store(Request $request)
    {
        $roombook = new RoomBook();
        $roombook->name = $request->name;
        $roombook->phone = $request->phone;
        $roombook->checkin = $request->checkin;
        $roombook->checkout = $request->checkout;
        $roombook->roomtype = $request->roomtype;
        $roombook->roomno = $request->roomno;
        $roombook->guestn = $request->guestn;
        $roombook->message = $request->message;

        $roombook->save();
        return redirect('bookview') ->with('success', 'Room Reserved successfully!');
    }
    
}
