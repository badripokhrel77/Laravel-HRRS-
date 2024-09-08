<?php

namespace App\Http\Controllers;
use App\Models\RoomBook;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomBookController extends Controller
{
    public function book($id)
{
    $user = auth()->user(); // Fetch the authenticated user
    $room = Room::findOrFail($id);
    return view('frontend/room/book', compact('room', 'user'));
}

    public function bookview()
    {
        return view('frontend.room.bookview');
    }

    public function store(Request $request)
    {
        $user = auth()->user(); // Assuming the user is logged in
        
        // Fetch the room using the ID passed in the request or session
        $room = Room::findOrFail($request->room_id); // Make sure room_id is passed from the form
    
        $roombook = new RoomBook();
        $roombook->user_id = $user->id;
        $roombook->name = $user->f_name . ' ' . $user->l_name;
        $roombook->phone = $user->phone;
        $roombook->roomtype = $room->category_id; // Ensure category is not null
        $roombook->roomno = $room->name; // Assign the room number correctly
        $roombook->checkin = $request->checkin;
        $roombook->checkout = $request->checkout;
        $roombook->guestn = $request->guestn;
        $roombook->message = $request->message;
    
        $roombook->save();
    
        if ($request->payment_type == 'online') {
            // Handle online payment here
        }
    
        // Handle offline or non-payment types
    }
    
}
