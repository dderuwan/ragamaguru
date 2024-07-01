<?php

use Illuminate\Support\Facades\Route;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Http\Controllers\LangController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Auth::routes();

Route::view('/home', 'home')->name('home');
Route::view('/store', 'store')->name('store');

Route::get('lang/home', [LangController::class,'index']);
Route::get('lang/change', [LangController::class,'change'])->name('changeLang');


// Authentication Routes
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');


?>


