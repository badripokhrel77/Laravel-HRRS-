<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Room; // Import the Room model
use App\Models\RoomBook; // Import the Booking model
use Illuminate\Support\Carbon; // Import Carbon for date handling

class AdminController extends Controller
{
    public function index()
    {
        // Calculate the total revenue
         $totalRevenue = Transaction::whereIn('payment_status', ['online', 'cash', 'success', 'completed'])->sum('amount');
    
        // Calculate the number of users
        $totalUsers = User::count();
    
        // Calculate the total number of booked rooms in the last 7 days
        $startDate = Carbon::now()->subDays(7);
        $bookedRooms = RoomBook::whereIn('room_status', ['booked', 'check-out'])
            ->where('created_at', '>=', $startDate)
            ->get(); // Get the actual booked rooms
    
        // Calculate the number of available rooms
        $availableRooms = Room::where('room_status', 'available')->count();
    
        // Pass the data to the view
        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalRevenue' => $totalRevenue,
            'bookedRooms' => $bookedRooms, // Pass the collection
            'availableRooms' => $availableRooms,
        ]);
    }
    
}
