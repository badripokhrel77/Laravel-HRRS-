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
        $last7DaysBookedRooms = RoomBook::whereIn('room_status', ['booked', 'check-out'])
            ->where('created_at', '>=', $startDate)
            ->get(); // Get the actual booked rooms


        $currentBookedRooms = RoomBook::where('room_status', 'booked')->get();

        // Calculate the number of available rooms
        $availableRooms = Room::where('room_status', 'available')->count();

        // Calculate the total number of canceled rooms in the last month
        $canceledRooms = RoomBook::where('room_status', 'cancel')
            ->where('created_at', '>=', Carbon::now()->subMonth())
            ->get(); // Get the actual canceled rooms


        // Pass the data to the view
        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalRevenue' => $totalRevenue,
            'currentBookedRooms' => $currentBookedRooms,
            'last7DaysBookedRooms' => $last7DaysBookedRooms,
            'availableRooms' => $availableRooms,
            'canceledRooms' => $canceledRooms,
        ]);
    }
}
