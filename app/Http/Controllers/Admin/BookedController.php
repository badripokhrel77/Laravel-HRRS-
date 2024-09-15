<?php

namespace App\Http\Controllers\Admin;

use App\Models\RoomBook;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookedController extends Controller
{
    public function index(Request $request)
{
    // Capture search input
    $search = $request->input('search');

    // Modify the query to handle searching by name or room number
    $query = RoomBook::query();
    if ($search) {
        $query->whereHas('user', function($q) use ($search) {
            $q->where('f_name', 'LIKE', "%{$search}%")
              ->orWhere('l_name', 'LIKE', "%{$search}%");
        })->orWhere('roomno', 'LIKE', "%{$search}%");
    }

    // Update the room status based on current date
    $today = Carbon::today();
    $query->get()->each(function ($roomBook) use ($today) {
        if ($roomBook->room_status === null) {
            if ($today->greaterThanOrEqualTo(Carbon::parse($roomBook->checkin)) &&
                $today->lessThanOrEqualTo(Carbon::parse($roomBook->checkout))) {
                $roomBook->update(['room_status' => 'check in']);
            } elseif ($today->greaterThan(Carbon::parse($roomBook->checkout))) {
                $roomBook->update(['room_status' => 'check out']);
            }
        }
    });

    // Paginate the results and pass to the view
    $roombook = $query->orderBy('id', 'desc')->paginate(7);

    return view('admin.roombook.index', [
        'roombook' => $roombook,
    ]);
}

    public function store(Request $request)
    {
        // Validate the form inputs
        $validatedData = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
            'guestn' => 'required|integer|min:1|max:10',
            'message' => 'nullable|string',
            'payment_type' => 'required|in:cash,online',
        ]);

        // Determine the status based on payment type
        $status = $request->payment_type === 'online' ? 'success' : 'pending';

        // Create a new booking record
        RoomBook::create([
            'user_id' => $request->user_id,
            'room_id' => $request->room_id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'guestn' => $request->guestn,
            'message' => $request->message,
            'payment_type' => $request->payment_type,
            'status' => $status,
            'room_status' => null, // Set the room status to 'check in'
        ]);

        return redirect()->back()->with('success', 'Room booking submitted successfully!');
    }

    public function edit($id)
    {
        // Fetch the RoomBook record by ID
        $roomBook = RoomBook::findOrFail($id);

        // Return the edit view with the RoomBook data
        return view('admin.roombook.edit', [
            'roomBook' => $roomBook
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate the form inputs
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|regex:/^[\d\s\+\-\(\)]+$/|min:10|max:15',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after_or_equal:checkin',
            'guestn' => 'required|integer|min:1|max:10',
        ]);

        try {
            // Fetch the specific RoomBook record by ID
            $roomBook = RoomBook::findOrFail($id);

            // Update the RoomBook details
            $roomBook->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'checkin' => $request->checkin,
                'checkout' => $request->checkout,
                'guestn' => $request->guestn,
            ]);

            return redirect(route('roombook.index'))->with('success', 'RoomBook details updated successfully!');
        } catch (\Exception $e) {
            // Log the error and redirect back with an error message
            \Log::error('RoomBook update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update RoomBook details. Please try again.');
        }
    }

    public function show($id)
    {
        // Fetch the room booking by ID
        $roomBook = RoomBook::findOrFail($id);

        // Return the view with the room booking data
        return view('admin.roombook.show', [
            'roomBook' => $roomBook
        ]);
    }

    public function destroy($id)
    {
        // Find and delete the specific booking record
        $roombook = RoomBook::findOrFail($id);
        $roombook->delete();

        return redirect(route('roombook.index'))->with('success', 'Booked Room deleted successfully!');
    }
}
