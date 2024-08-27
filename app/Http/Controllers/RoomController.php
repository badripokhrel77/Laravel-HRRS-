<?php

namespace App\Http\Controllers;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function room(){
        $rooms = Room::all();
         
        return view('frontend.room.index', compact('rooms'));
    }

    public function index()
    {
        $rooms = Room::all();
        return view('room.index', compact('rooms'));
    }
}
