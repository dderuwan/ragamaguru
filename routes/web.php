<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Auth::routes();

Route::view('/home', 'home')->name('home');

?>


