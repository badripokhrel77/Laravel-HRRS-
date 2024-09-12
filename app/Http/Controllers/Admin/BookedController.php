<?php
namespace App\Http\Controllers\Admin;
use App\Models\RoomBook;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookedController extends Controller
{
    public function index()
    {
        return view('admin/roombook/index', [
            'roombook' => RoomBook::orderBy('id', 'desc')->paginate(10),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'checkin' => 'required|date',
            'checkout' => 'required|date',
            'guestn' => 'required|integer|min:1|max:10',
            'message' => 'nullable',
            'payment_type' => 'required|in:cash,online',
        ]);

        $status = $request->payment_type === 'online' ? 'success' : 'pending';

        RoomBook::create([
            'user_id' => $request->user_id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'guestn' => $request->guestn,
            'message' => $request->message,
            'payment_type' => $request->payment_type,
            'status' => $status,
        ]);

        return redirect()->back()->with('success', 'Room booking submitted successfully!');
    }

    public function destroy($id)
    {
        $roombook = RoomBook::findOrFail($id);
        $roombook->delete();
        return redirect(route('roombook.index'))->with('success', 'Booked Room deleted successfully!');
    }
}
