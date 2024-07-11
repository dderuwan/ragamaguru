<?php
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\TreatementController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();


Route::view('/home', 'home')->name('home');
Route::view('/store', 'store')->name('store');
Route::view('/appointment', 'appointment')->name('appointment');
Route::view('/products', 'products')->name('products');
Route::view('/cart', 'cart')->name('cart');

Route::get('/products', [ProductController::class, 'show'])->name('products');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/delete-from-cart', [CartController::class, 'deleteFromCart'])->name('deleteFromCart');
Route::get('/cart-item-count', [CartController::class, 'getItemCount'])->name('cartItemCount');

Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('clearCart');

Route::get('lang/home', [LangController::class,'index']);
Route::get('lang/change', [LangController::class,'change'])->name('changeLang');


// Authentication Routes
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');


// Password Reset Routes
Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');



Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// customer module
Route::get('/allcustomers', [CustomerController::class,'index'])->name('allcustomers');
Route::get('/createCustomer', [CustomerController::class, 'create'])->name('createcustomer');
Route::post('/storeCustomer', [CustomerController::class, 'store'])->name('storecustomer');
Route::post('/verifyCustomer', [CustomerController::class, 'verify'])->name('verifycustomer');
Route::get('/editCustomer/{id}', [CustomerController::class, 'edit'])->name('editcustomer');
Route::post('/updateCustomer', [CustomerController::class, 'update'])->name('updatecustomer');
Route::delete('/deleteCustomer/{id}', [CustomerController::class, 'destroy'])->name('deletecustomer');

//Treatment module
Route::get('/Treatment', [App\Http\Controllers\TreatmentController::class, 'index'])->name('Treatment');
Route::get('/createTreatment', [App\Http\Controllers\TreatmentController::class, 'create'])->name('createTreatment');
Route::get('/editTreatment/{id}', [App\Http\Controllers\TreatmentController::class, 'edit'])->name('editTreatment');
Route::post('/updateTreatment',[App\Http\Controllers\TreatmentController::class, 'update'])->name('updateTreatment');
Route::post('/storeTreatment', [App\Http\Controllers\TreatmentController::class, 'store'])->name('storeTreatment');
Route::delete('/deleteTreatment/{id}', [App\Http\Controllers\TreatmentController::class, 'destroy'])->name('deleteTreatment');






?>


