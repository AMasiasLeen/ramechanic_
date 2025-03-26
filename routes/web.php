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



Auth::routes();

Route::middleware(["auth"])->group(function () {
    Route::get("users/{user}/profile", [UserController::class, "show_profile"])->name("users.profile")->middleware(ShowOwnProfile::class);
    Route::get("users/{user}/edit_profile", [UserController::class, "edit_profile"])->name("users.edit_profile")->middleware(ShowOwnProfile::class);
    Route::put("users/user/{user}", [UserController::class, "update"])->name("users.update_user");
    Route::get('/instructions', [HomeController::class, 'show_instructions'])->name('instructions');
    Route::get("records/user-records", [RecordController::class, "show_user_record"])->name("records.user_records");
    Route::get("vehicles/user-vehicle", [RecordController::class, "show_user_vehicles"])->name("vehicles.user_vehicles");
    Route::get('/vehicles/records', [HomeController::class, 'vehicles'])->name('vehicles_records');
    Route::get('/vehicles/user_vehicles', [VehicleController::class, 'user_vehicles'])->name('vehicles.user_vehicles');
});

Route::get('/', [HomeController::class, 'landing_page'])->name('landing_page');
Route::delete('/vehicles/{vehicle}/image', [VehicleController::class, 'deleteImage'])
     ->name('vehicles.delete-image');


Route::middleware(["auth", AdminMiddleware::class])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource("users", UserController::class);
    Route::resource("roles", RoleController::class);
    Route::resource("brands", BrandController::class);
    Route::resource("vehicle-models", VehicleModelController::class);
    Route::resource("vehicles", VehicleController::class);
    Route::resource("records", RecordController::class);
});
