<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
{
    $query = Room::query();

    // Check if a search query is present
    if ($request->has('search') && $request->search != '') {
        $searchTerm = $request->input('search');
        $query->where(function($q) use ($searchTerm) {
            $q->where('name', 'LIKE', "%{$searchTerm}%")
              ->orWhereHas('category', function($query) use ($searchTerm) {
                  $query->where('title', 'LIKE', "%{$searchTerm}%");
              });
        });
    }

    // Retrieve rooms with pagination
    $rooms = $query->orderBy('id', 'desc')->paginate(5);

    return view('admin/room/index', [
        'rooms' => $rooms,
    ]);
}

    

    
    public function create()
    {
        
        return view('admin/room/create',[
'categories'=> RoomCategory::all()
        ]);
       
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:room_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for image
        ]);
    
        $room = new Room();
        $room->category_id = $request->category_id;
        $room->name = $request->name;
        $room->description = $request->description;
        $room->price = $request->price;
    
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $imagename = time() . $file->getClientOriginalName();
            $file->move('room_files', $imagename);
            $room->image = 'room_files/' . $imagename;
        }
        $room->save();
        return redirect(route('rooms.index'))->with('success', 'Room added successfully!');
    }
    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for image
        ]);
    
        $room = Room::findOrFail($id);
        $room->name = $request->name;
        $room->description = $request->description;
        $room->price = $request->price;
        
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $imagename = time() . $file->getClientOriginalName();
            $file->move('room_files', $imagename);
            $room->image = 'room_files/' . $imagename;
        }
        $room->save(); // Use save() instead of update() after modifying attributes
    
        return redirect(route('rooms.index'))->with('success', 'Room updated successfully!');
    }
        public function edit($id)
    {
        return view('admin/room/edit', [
            'room' =>Room::findOrFail($id)
        ]);
    }
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
       $room->delete();
       return redirect(route('rooms.index'))->with('success', 'Room deleted successfully!');
    }
}



