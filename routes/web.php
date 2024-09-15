
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
use App\Http\Controllers\Admin\RoomCategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\RoomBookController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ContactController;
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
Route::get('/category/{category_id}',[RoomController::class,'categoryWiseRoom']);

//Book
Route::get('/book/{id}',[RoomBookController::class,'book'])->middleware('auth');;
// Route for Book View with ID parameter
route::get('/bookview/{id}', [RoomBookController::class, 'bookview'])->name('bookview');

Route::post('/book',[RoomBookController::class,'store']);

Route::get('/khalti/callback',[RoomBookController::class,'khaltiCallback']);

// contact
// Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// admin routes
Route::prefix('admin')->middleware(['is_auth','is_admin'])->group(function() {
    Route::get('/dashboard', [AdminController::class, 'index']);
    
    Route::resource('rooms', App\Http\Controllers\Admin\RoomController::class);
    Route::resource('userinfo', App\Http\Controllers\Admin\UserinfoController::class);
    Route::resource('roomcategory', App\Http\Controllers\Admin\RoomCategoryController::class);
    Route::resource('roombook', App\Http\Controllers\Admin\BookedController::class);
});


/// User routes
Route::prefix('user')->middleware(['is_auth'])->group(function(){
    Route::get('/profile', [UserController::class, 'index']);
    Route::resource('profile', App\Http\Controllers\User\ProfileController::class);
    Route::resource('reservedroom', App\Http\Controllers\User\ReservedRoomController::class);

    // Custom route for viewing a single reservation
    Route::get('/reservedroom/{id}/view', [App\Http\Controllers\User\ReservedRoomController::class, 'bookview'])->name('reservedroom.bookview');



    Route::post('/profile/change-password', [App\Http\Controllers\User\ProfileController::class, 'changePassword'])->name('password.change');

    // Route for updating profile image
    route::put('/profile-update-image', [App\Http\Controllers\User\ProfileController::class, 'updateImage'])->name('profile.updateImage');
});



Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
