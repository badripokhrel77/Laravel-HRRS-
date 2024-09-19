<?php

namespace App\Http\Controllers\Admin;

use App\Models\RoomBook;
use App\Models\Room;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
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
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('f_name', 'LIKE', "%{$search}%")
                    ->orWhere('l_name', 'LIKE', "%{$search}%");
            })->orWhere('roomno', 'LIKE', "%{$search}%");
        }
        // Paginate the results and pass to the view
        $roombook = $query->with('transaction')->orderBy('id', 'desc')->paginate(7);
        
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
        $status = $request->payment_type === 'online' ? 'pending' : 'cash'; // Changed to 'pending' for online payments

        // Create a new booking record
        RoomBook::create([
            'user_id' => $request->user_id,
            'room_id' => $request->room_id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'guestn' => $request->guestn,
            'message' => $request->message,
            'payment_type' => $request->payment_type,
            'status' => $request->payment_status,
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
           
            'checkin' => 'required|date',
            'checkout' => 'required|date|after_or_equal:checkin',
            'guestn' => 'required|integer|min:1|max:10',
            'room_status' => 'required|string|in:booked,check-in,check-out',
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
                'room_status' => $request->room_status,
            ]);

            $transaction = Transaction::where('roombook_id', $id)->first();
            $transaction->payment_status = $request->status;
            $transaction->update();

            $room = Room::find($roomBook->room_id);

            // Update the Room's status based on the RoomBook's status
            if ($request->room_status === 'check-out') {
                $room->room_status = 'available';
            } else {
                $room->room_status = 'booked';
            }

            // Save the Room's updated status
            $room->save();

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
        $room = Room::find($roombook->room_id);
        $room->room_status = "available";
        $room->save();

        $roombook->delete();

        return redirect(route('roombook.index'))->with('success', 'Booked Room deleted successfully!');
    }
}
