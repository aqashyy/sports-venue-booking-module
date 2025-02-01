<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\VenueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->controller(AuthController::class)->group(function () {

    Route::post('register','register');
    Route::post('login','login');
    Route::get('logout','logout')->middleware('auth:sanctum');

});

Route::prefix('venue')->middleware('auth:sanctum')->group(function () {

    Route::post('book',[BookingController::class,'bookNow']);
    Route::get('list',[VenueController::class,'listVenues']);
});
