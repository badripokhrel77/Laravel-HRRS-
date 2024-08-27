<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        return view('admin/room/index', [
            'rooms' => Room::orderBy('id','desc')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin/room/create');
    }

    public function store(Request $request)
    {
        $room =new Room();
        $room->name = $request->name;
        $room->description = $request->description;
        $room->price = $request->price;
    
        if($request->hasFile("image")){
            $file= $request->file("image");
            $imagename=time().$file->getClientOriginalName();
            $file->move('room_files',$imagename);
            $room->image = 'room_files/'.$imagename;
        }
        $room->save();
        return redirect(route('rooms.index'))->with('success', 'Room added successfully!');
    }

    public function edit($id)
    {
        return view('admin/room/edit', [
            'room' =>Room::findOrFail($id)
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $room->name = $request->name;
        $room->description = $request->description;
        $room->price = $request->price;
        if($request->hasFile("image")){
            $file= $request->file("image");
            $imagename=time().$file->getClientOriginalName();
            $file->move('room_files',$imagename);
            $room->image = 'room_files/'.$imagename;
        }
        $room->update();

        return redirect(route('rooms.index'))->with('success', 'Room Updated successfully!');
    }
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
       $room->delete();
       return redirect(route('rooms.index'))->with('success', 'Room deleted successfully!');
    }
}



