<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleModelController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(["auth", AdminMiddleware::class])->group(function () {
    Route::resource("users", UserController::class);
    Route::resource("roles", RoleController::class);
    Route::resource("brands", BrandController::class);
    Route::resource("vehicle-models", VehicleModelController::class);
    Route::resource("vehicles", VehicleController::class);
});
