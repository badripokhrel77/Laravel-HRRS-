<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;use App\models\Room;


class FrontendController extends Controller
{
    function index(){
        return view('frontend.index', [
            'rooms' => Room::all()
        ]);
    }
    function home(){
        return view('frontend.index', [
            'rooms' => Room::all()
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