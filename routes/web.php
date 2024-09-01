
<?php

use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\User\UserController;

use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\UserinfoController as AdminUserinfoController ;
use App\Http\Controllers\Admin\BookedController as AdminBookedController ;

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\RoomBookController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ContactController;

use App\Models\RoomCategory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;


// frontend
Route::get('/',[FrontendController::class,'index']);
Route::get('/home',[FrontendController::class,'home']);
Route::get('/about',[FrontendController::class,'about']);
Route::get('/contact',[FrontendController::class,'contact']);
Route::get('/gallery',[FrontendController::class,'gallery']);

// room
Route::get('/room',[RoomController::class,'room']);

//Book
Route::get('/book/{id}',[RoomBookController::class,'book'])->middleware('auth');;
Route::get('/bookview/{id)',[RoomBookController::class,'bookview']);
Route::post('/book',[RoomBookController::class,'store']);

// contact
// Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');


// auth
// Route::get('/login',[LoginController::class, 'index']);
// Route::post('/login',[LoginController::class, 'store']);
// Route::get('/register',[RegisterController::class,'index']);
// Route::post('/register',[RegisterController::class,'store']);

// Password Reset Request
// Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Password Reset
// Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// admin routes
Route::prefix('admin')->middleware('is_auth')->group(function(){
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::resource('rooms', App\Http\Controllers\Admin\RoomController::class);
    Route::resource('userinfo', App\Http\Controllers\Admin\UserinfoController::class);
    Route::resource('roombook', App\Http\Controllers\Admin\BookedController::class);
});

// User routes
Route::prefix('user')->middleware('is_auth')->group(function(){
    Route::get('/dashboard', [UserController::class, 'index']);
    Route::resource('profile', App\Http\Controllers\User\profileController::class);
    Route::resource('reservedroom', App\Http\Controllers\User\ReservedRoomController::class);
});


Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
