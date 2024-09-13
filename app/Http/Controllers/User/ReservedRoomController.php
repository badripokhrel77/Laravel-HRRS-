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
        return view('user.reservedroom.bookview', compact('book'));  // Pass the booking data to a view
    }
}
