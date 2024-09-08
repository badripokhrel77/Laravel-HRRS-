<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;use App\models\Room;
use App\Models\RoomCategory;

class FrontendController extends Controller
{
    function index(){
        return view('frontend.index', [
            'rooms' => Room::all(),
            'categories'=> RoomCategory::all(),
        ]);
    }
    function home(){
        return view('frontend.index', [
            'rooms' => Room::all(),
            'categories'=> RoomCategory::all(),
        ]);
    }
    function about(){
        return view('frontend.about');
    }
    function contact(){
        return view('frontend.contact');
    }
    function gallery(){
        return view('frontend.gallery');
    }
  
    function room(){
        return view('frontend.room.index');
    }
}