<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(["auth"])->group(function () {
    Route::resource("brands", BrandController::class);

    Route::resource("vehicles", VehicleController::class);

    
});
