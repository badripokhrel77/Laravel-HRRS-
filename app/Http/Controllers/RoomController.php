<?php

namespace App\Http\Controllers;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function room(){
        $rooms = Room::all();
         
        return view('frontend.room.index', [compact('rooms'),'categories'=> RoomCategory::all(),'rooms' => Room::all(),]);
    }

    public function index()
    {
        $rooms = Room::all();
        return view('room.index', compact('rooms'));
    }
    public function categoryWiseRoom($category_id)
    {
        $rooms = Room::where('category_id',$category_id)->get();
        $category=RoomCategory::findOrFail($category_id);
        return view('frontend.category-detail', compact('rooms','category'));
    }
}
