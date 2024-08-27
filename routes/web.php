<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\UserinfoController as AdminUserinfoController ;
use App\Http\Controllers\Admin\BookedController as AdminBookedController ;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\RoomBookController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\RoomCategory;
use Illuminate\Support\Facades\Route;

// frontend
Route::get('/',[FrontendController::class,'index']);
Route::get('/home',[FrontendController::class,'home']);
Route::get('/about',[FrontendController::class,'about']);
Route::get('/contact',[FrontendController::class,'contact']);
Route::get('/gallery',[FrontendController::class,'gallery']);

// room
Route::get('/room',[RoomController::class,'room']);

//Book
Route::get('/book',[RoomBookController::class,'book']);
Route::get('/bookview',[RoomBookController::class,'bookview']);
Route::post('/book',[RoomBookController::class,'store']);

// auth
Route::get('/login',[LoginController::class, 'index']);
Route::post('/login',[LoginController::class, 'store']);
Route::get('/register',[RegisterController::class,'index']);
Route::post('/register',[RegisterController::class,'store']);

// admin routes
Route::prefix('admin')->group(function(){
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::resource('rooms', App\Http\Controllers\Admin\RoomController::class);
    Route::resource('userinfo', App\Http\Controllers\Admin\UserinfoController::class);
    Route::resource('roombook', App\Http\Controllers\Admin\BookedController::class);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
