<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->controller(AuthController::class)->group(function () {

    Route::post('register','register');
    Route::post('login','login');
    Route::get('logout','logout')->middleware('auth:sanctum');

});
