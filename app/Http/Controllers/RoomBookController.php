<?php

namespace App\Http\Controllers;

use App\Models\RoomBook;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomBookController extends Controller
{
    // Display booking form for a specific room
    public function book($id)
    {
        $user = auth()->user(); // Fetch the authenticated user
        $room = Room::findOrFail($id); // Fetch the room by its ID
        return view('frontend.room.book', compact('room', 'user'));
    }

    // View bookings
    public function bookview($id)
    {
        $book= RoomBook::findOrFail($id);
        return view('frontend.room.bookview', compact('book'));
    }

    // Store booking details
    public function store(Request $request)
    {
    
        
        $user = auth()->user(); // Ensure user is authenticated
        // Find the room by ID (Make sure room_id is passed from the form)
        // $room = Room::findOrFail($request->room_id); 

        // Create a new booking instance
        $roombook = new RoomBook();
        $roombook->user_id = $user->id;
        $roombook->room_id = $request->room_id;
        $roombook->name = $user->f_name . ' ' . $user->l_name; // Concatenate first and last name
        $roombook->phone = $user->phone;
        $roombook->roomtype = $request->roomtype; // Reference room category ID
        $roombook->roomno = $request->roomno; // Use the room name as the room number
        $roombook->checkin = $request->checkin;
        $roombook->checkout = $request->checkout;
        $roombook->guestn = $request->guestn;
        $roombook->message = $request->message;
        
        // Handle payment type and set booking status accordingly
        if ($request->payment_type == 'online') {
            $roombook->status = 'success'; // Online payment success
            // Handle online payment logic (e.g., integration with payment gateway)
        } else {
            $roombook->status = 'pending'; // Cash payment or offline booking
        }

        // Save the booking to the database
        $roombook->save();
       
        // Return response, such as redirecting the user or showing a success message
        return redirect()->route('bookview', ['id' => $roombook->id])->with('success', 'Booking successful!');
    }
}
