<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaction; // Make sure this import is present
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Calculate the total revenue
        $totalRevenue = Transaction::sum('amount');

        // Other data you might need
        $totalUsers = User::count();
        $bookedRooms = 120; // This should be dynamic based on your data
        $availableRooms = 25; // This should be dynamic based on your data

        // Pass the data to the view
        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalRevenue' => $totalRevenue,
            'bookedRooms' => $bookedRooms,
            'availableRooms' => $availableRooms,
        ]);
    }
}
