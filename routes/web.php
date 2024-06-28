<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Auth::routes();

Route::view('/home', 'home')->name('home');


// Authentication Routes
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');


?>


