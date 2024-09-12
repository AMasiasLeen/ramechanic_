<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleModelController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ShowOwnProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(["auth"])->group(function(){
    Route::get("users/{user}/profile",[UserController::class,"show_profile"]) -> name("users.profile") -> middleware(ShowOwnProfile::class);
    Route::get("users/{user}/edit_profile",[UserController::class,"edit_profile"]) -> name("users.edit_profile")-> middleware(ShowOwnProfile::class);
    Route::get('/instructions', [HomeController::class, 'show_instructions'])->name('instructions');
    Route::get("records/user-records",[RecordController::class,"show_user_record"]) -> name("records.user_records");
    
});



Route::middleware(["auth", AdminMiddleware::class])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource("users", UserController::class);
    Route::resource("roles", RoleController::class);
    Route::resource("brands", BrandController::class);
    Route::resource("vehicle-models", VehicleModelController::class);
    Route::resource("vehicles", VehicleController::class);
    Route::resource("records", RecordController::class);
});
