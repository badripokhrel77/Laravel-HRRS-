<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RoomBook;
use Illuminate\Http\Request;

class ReservedRoomController extends Controller
{
    // Method to list all reservations for the user
    public function index()
    {
        
        $bookings = RoomBook::all();  // Fetch all bookings (or use a filtered query)
       
        return view('user.index', compact('bookings'));  // Pass bookings to the index view
    }

    // Method to view a specific booking by ID
    public function bookview($id)
    {
        $book = RoomBook::findOrFail($id);  // Fetch a specific booking by ID
        return view('frontend.room.bookview', compact('book'));  // Pass the booking data to a view
    }



    
    public function cancel($id)
    {
        // Find the RoomBook instance by ID
        $booking = RoomBook::find($id);
    
        if ($booking) {
            // Update the associated room status to 'available'
            if ($booking->room) {
                $booking->room->room_status = 'available';
                $booking->room->save();
            }
    
            // Update the RoomBook's own status to 'cancel' (correct spelling)
            $booking->room_status = 'cancel'; 
            $booking->save();
    
            // Update the associated transaction's payment status to '-'
            if ($booking->transaction) {
                $booking->transaction->payment_status = '-';
                $booking->transaction->payment_method = 'N/A';
                $booking->transaction->amount = 0 ;
                $booking->transaction->save();
            }
    
            // Redirect back with success message
            return redirect()->route('reservedroom.index')->with('success', 'Reservation has been cancelled.');
        }
    
        // Handle the case where the booking is not found
        return redirect()->route('reservedroom.index')->with('error', 'Reservation not found.');
    }
}    