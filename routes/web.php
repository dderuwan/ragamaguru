<?php
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ItemController;
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
Route::resource('customer', CustomerController::class);
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
Route::get('/editTreatment', [App\Http\Controllers\TreatmentController::class, 'edit'])->name('editTreatment');
Route::post('/updateTreatment/{id}',[App\Http\Controllers\TreatmentController::class, 'update'])->name('updateTreatment');
Route::post('/storeTreatment', [App\Http\Controllers\TreatmentController::class, 'store'])->name('storeTreatment');
Route::delete('/deleteTreatment/{id}', [App\Http\Controllers\TreatmentController::class, 'destroy'])->name('deleteTreatment');



// supplier module
Route::resource('supplier', SupplierController::class);
Route::get('/allsuppliers', [SupplierController::class,'index'])->name('allsuppliers');
Route::get('/createSupplier', [SupplierController::class, 'create'])->name('createsupplier');
Route::post('/storeSupplier', [SupplierController::class, 'store'])->name('storesupplier');
Route::get('/editSupplier/{id}', [SupplierController::class, 'edit'])->name('editsupplier');
Route::post('/updateSupplier', [SupplierController::class, 'update'])->name('updatesupplier');






// Item module
Route::resource('item', ItemController::class);
Route::get('/items', [ItemController::class, 'index'])->name('item.index'); 
Route::get('/items/create', [ItemController::class, 'create'])->name('createitem'); 
Route::post('/items', [ItemController::class, 'store'])->name('items.store'); 
Route::get('/edititem/{id}', [App\Http\Controllers\ItemController::class, 'edit'])->name('edititem');
Route::put('/updateitem/{id}', [App\Http\Controllers\ItemController::class, 'update'])->name('updateitem');
Route::get('/get-supplier-codes', [ItemController::class, 'getSupplierCodes']);


//OrderRequests module
Route::get('/allorderrequests', [App\Http\Controllers\OrderRequestContralller::class, 'index'])->name('allorderrequests');
Route::get('/createorderrequests', [App\Http\Controllers\OrderRequestContralller::class, 'create'])->name('OrderRequests.create');
Route::post('/insertorderrequests', [App\Http\Controllers\OrderRequestContralller::class, 'store'])->name('OrderRequests.store'); 
Route::get('/showorderrequests/{id}', [App\Http\Controllers\OrderRequestContralller::class, 'show'])->name('OrderRequests.show');
Route::delete('/deleteorderrequests/{id}', [App\Http\Controllers\OrderRequestContralller::class, 'destroy'])->name('OrderRequests.destroy');

// API Routes for fetching items and stock
Route::get('/api/get-items/{supplierCode}', [App\Http\Controllers\OrderRequestContralller::class, 'getItemsBySupplier']);
Route::get('/api/get-item-stock/{itemCode}', [App\Http\Controllers\OrderRequestContralller::class, 'getItemStock']);


// GIN
Route::get('/allgins', [App\Http\Controllers\GinController::class, 'index'])->name('allgins');
Route::get('/creategin', [App\Http\Controllers\GinController::class, 'create'])->name('creategin');
Route::post('/insertgin', [App\Http\Controllers\GinController::class, 'store'])->name('insertgin');
Route::get('/showogins/{id}', [App\Http\Controllers\GinController::class, 'show'])->name('showogins');
Route::delete('/deletegins/{id}', [App\Http\Controllers\GinController::class, 'destroy'])->name('deletegins');

//reports
Route::get('/orderreport', [App\Http\Controllers\ReportController::class, 'orderreport'])->name('orderreport');
Route::get('/productreport', [App\Http\Controllers\ReportController::class, 'productreport'])->name('productreport');
Route::get('/customerreport', [App\Http\Controllers\ReportController::class, 'customerreport'])->name('customerreport');
Route::get('/supplierreport', [App\Http\Controllers\ReportController::class, 'supplierreport'])->name('supplierreport');
Route::get('/ginreport', [App\Http\Controllers\ReportController::class, 'ginreport'])->name('ginreport');
Route::get('/ginshow/{id}', [App\Http\Controllers\ReportController::class, 'ginshow'])->name('ginshow');
Route::get('/purchaseorderreport', [App\Http\Controllers\ReportController::class, 'purchaseorderreport'])->name('purchaseorderreport');
Route::get('/purchaseordershow/{id}', [App\Http\Controllers\ReportController::class, 'purchaseordershow'])->name('purchaseordershow');
Route::get('orderreport/print/{id}', [App\Http\Controllers\ReportController::class, 'printOrderReport'])->name('orderreport.print');
Route::delete('/deleteorderreport/{id}', [App\Http\Controllers\ReportController::class, 'destroy'])->name('orderreport.destroy');
Route::delete('/customerdestroy/{id}', [App\Http\Controllers\ReportController::class, 'customerdestroy'])->name('customerdestroy');
Route::delete('/supplierdestroy/{id}',[App\Http\Controllers\ReportController::class,'supplierdestroy'])->name('supplierdestroy');
Route::delete('/gindestroy/{id}', [App\Http\Controllers\ReportController::class, 'gindestroy'])->name('gindestroy');
Route::delete('/purchaseorderdestroy/{id}', [App\Http\Controllers\ReportController::class, 'purchaseorderdestroy'])->name('purchaseorderdestroy');

// routes/web.php
Route::get('/api/get-order-items/{orderRequestCode}', [GinController::class, 'getOrderItems']);

 //POS
 Route::get('/pospage', [App\Http\Controllers\POSController::class, 'showHomepage'])->name('pospage');
 Route::post('/POS.store', [App\Http\Controllers\POSController::class, 'store'])->name('POS.store');
 Route::post('/POS.customerstore', [App\Http\Controllers\POSController::class, 'customerstore'])->name('POS.customerstore');
 Route::get('/showpos/{id}', [App\Http\Controllers\POSController::class, 'show'])->name('showopos');
 Route::delete('/deletepos/{id}', [App\Http\Controllers\POSController::class, 'destroy'])->name('deletepos');

 Route::get('/download-order-pdf/{order_id}', [POSController::class, 'downloadOrderPdf'])->name('downloadOrderPdf');



?>




