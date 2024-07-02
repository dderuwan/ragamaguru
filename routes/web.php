<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use app\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('frontend.home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
