<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CustomerAuthController;

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\AppointmentSettingsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlockedDateController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GinController;
use App\Http\Controllers\OfferItemsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\CompanySettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RegisterController as ControllersRegisterController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Default Dashboard Route (for regular users)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes (for regular users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Admin Authentication Routes
 */
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Protected routes for admin after login
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');  // Create this view for admin dashboard
        })->name('admin.dashboard');
    });
});



/**
 * Customer Authentication Routes
 */
Route::prefix('customer')->group(function () {
    Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
    Route::post('/login', [CustomerAuthController::class, 'login']);
    Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

    // Protected routes for customer after login
    Route::middleware('auth:customer')->group(function () {
        Route::get('/dashboard', function () {
            return view('customer.dashboard');  // Create this view for customer dashboard
        })->name('customer.dashboard');
    });
});

// Include the default Breeze routes (registration, login, password reset for default user)
require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();


Route::view('/home', 'home')->name('home');
Route::view('/store', 'store')->name('store');
Route::view('/products', 'products')->name('products');
Route::view('/cart', 'cart')->name('cart');


Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/delete-from-cart', [CartController::class, 'deleteFromCart'])->name('deleteFromCart');
Route::get('/cart-item-count', [CartController::class, 'getItemCount'])->name('cartItemCount');
Route::get('/cart-checkout', [CartController::class, 'cartCheckout'])->name('cartCheckout');
Route::post('/store-cart-details', [CartController::class, 'storeCartDetails'])->name('storeCartDetails');

Route::post('/update-address/{id}', [CustomerController::class, 'updateAddress'])->name('updateAddress');

Route::post('/place-order', [CustomerOrderController::class, 'placeOrder'])->name('placeOrder');
Route::post('/clear-checkout', [CustomerOrderController::class, 'clearCheckout'])->name('clearCheckout');
Route::get('/onlineorders', [CustomerOrderController::class, 'onlineOrders'])->name('onlineOrders');
Route::get('/showonlineorder/{id}', [CustomerOrderController::class, 'showOnlineOrder'])->name('showOnlineOrder');
Route::delete('/deleteorder/{id}', [CustomerOrderController::class, 'destroy'])->name('order.destroy');
Route::post('/changestatus/{id}', [CustomerOrderController::class, 'changeStatus'])->name('changeStatus');

Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('clearCart');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Authentication Routes
// Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
// Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');


// register
Route::get('/register',[ControllersRegisterController::class, 'index'])->name('register.index');  
Route::post('/register/store',[ControllersRegisterController::class, 'store'])->name('register.store');  




// Password Reset Routes
Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');



Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/home', [HomeController::class, 'getHomeData'])->name('home');
Route::get('/store', [HomeController::class, 'getproducts'])->name('store');
Route::get('/product/{id}', [ProductController::class, 'showItems'])->name('products.show');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/profile', [HomeController::class, 'goToProfile'])->name('goToProfile');
Route::get('/orders/{order}', [HomeController::class, 'showOrderDetails'])->name('showOrderDetails');
Route::put('/updatedetails/{id}', [HomeController::class, 'updateCusDetails'])->name('updateCusDetails');









Route::post('/savecustomertreatments/{id}', [App\Http\Controllers\TreatmentController::class, 'saveCustomerTreatments'])->name('saveCustomerTreatments');
Route::post('/saveseconddaydetails/{id}', [App\Http\Controllers\TreatmentController::class, 'saveSecondDayDetails'])->name('saveSecondDayDetails');
Route::post('/savethirddaydetails/{id}', [App\Http\Controllers\TreatmentController::class, 'saveThirdDayDetails'])->name('saveThirdDayDetails');
Route::post('/saveotherdaydetails/{id}', [App\Http\Controllers\TreatmentController::class, 'saveOtherDayDetails'])->name('saveOtherDayDetails');
Route::get('/viewcustomertreat/{id}', [App\Http\Controllers\TreatmentController::class, 'viewCustomerTreat'])->name('viewCustomerTreat');
Route::post('/savetreatpayment/{id}', [App\Http\Controllers\TreatmentController::class, 'saveTreatPayment'])->name('saveTreatPayment');
Route::get('/viewduepayment/{id}', [App\Http\Controllers\TreatmentController::class, 'viewDuePayment'])->name('viewDuePayment');
Route::post('/saveduepayment/{id}', [App\Http\Controllers\TreatmentController::class, 'saveDuePayment'])->name('saveDuePayment');
Route::put('/treatments/update-next-day/{id}', [App\Http\Controllers\TreatmentController::class, 'updateNextDay'])->name('updateNextDay');
Route::get('/treatments/print-preview/{cusTreatId}', [App\Http\Controllers\TreatmentController::class, 'printPreview'])->name('treatments.printPreview');





//Purchase module
Route::resource('purchase', PurchaseController::class)->except(['show']);
Route::get('/purchase/order-create', [PurchaseController::class, 'create'])->name('createPurchaseOrder');
Route::get('/allpurchaseRequests', [PurchaseController::class, 'index'])->name('purchase.purchaseOrder');
Route::delete('/purchase/{purchase}', [PurchaseController::class, 'destroy'])->name('purchase.destroy');
Route::get('/purchase/get-items-by-supplier', [PurchaseController::class, 'getItemsBySupplier'])->name('get-items-by-supplier');
Route::post('/purchase/store', [PurchaseController::class, 'store'])->name('purchase.store');
Route::get('purchase/{request_code}', [PurchaseController::class, 'show'])->name('purchase.show');


//appointment module
// Route::view('/Appointments', 'appointment.index')->name('appointment');
// Route::get('/Appointments/New-appointment', [AppointmentController::class, 'showCustomers'])->name('new_appointment');
// Route::get('/Appointments/New-appointment/customers/{id}', [AppointmentController::class, 'getCustomerDetails']);
// Route::post('/Appointments/New-appointment/store', [AppointmentController::class, 'storeAppointments'])->name('appointment.store');
Route::get('/appointments/add/{id}', [AppointmentsController::class, 'create'])->name('appointments.create');
Route::post('/appointments/save', [AppointmentsController::class, 'store'])->name('appointments.store');
Route::get('/appointments', [AppointmentsController::class, 'index'])->name('appointments.index');
Route::get('/appointments/date/{date}', [AppointmentsController::class, 'getAppointmentsByDate'])->name('appointments.date');
Route::get('/appointments/print-preview/{appointmentId}', [AppointmentsController::class, 'printPreview'])->name('appointments.printPreview');
Route::delete('/appointments/{id}', [AppointmentsController::class, 'destroy'])->name('appointments.destroy');
Route::get('/showcalendarschedule', [AppointmentsController::class, 'showCalendarSchedule'])->name('showCalendarSchedule');
Route::get('/calendar-events', [AppointmentsController::class, 'getCalendarEvents'])->name('calendar.events');
Route::post('/check-appointments', [AppointmentsController::class, 'checkAppointments'])->name('checkAppointments');
Route::get('/viewbooking/{id}', [AppointmentsController::class, 'viewBooking'])->name('viewBooking');
Route::post('/add-appointment/{id}', [AppointmentsController::class, 'addAppointment'])->name('addAppointment');
Route::get('appointments/{type}/{date}', [AppointmentsController::class, 'getAppointmentsByTypeAndDate'])->name('appointments.byTypeAndDate');


Route::get('/localbookings', [BookingController::class, 'indexLocal'])->name('bookings.indexLocal');
Route::get('/inbookings', [BookingController::class, 'indexInternational'])->name('bookings.indexInternational');
Route::get('/localbookings/date/{date}', [BookingController::class, 'getLocalBookingsByDate'])->name('localbookings.date');
Route::get('/intbookings/date/{date}', [BookingController::class, 'getIntBookingsByDate'])->name('intbookings.date');
Route::post('/bookings/cancel/{id}', [BookingController::class, 'cancel'])->name('bookings.cancel');


// website appointment
Route::get('/booking-info', [HomeController::class, 'bookingInfo'])->name('bookingInfo');
Route::get('/customerappointments', [AppointmentsController::class, 'cusAppointmentCreate'])->name('cusAppointmentCreate');
Route::post('/check-date', [BookingController::class, 'checkDate'])->name('checkDate');
Route::post('/generate-otp', [BookingController::class, 'generateOtp'])->name('generate.otp');
Route::post('/verify-otp', [BookingController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/bookingstore', [BookingController::class, 'store'])->name('booking.store');
Route::post('/get-apnumber', [BookingController::class, 'getApNumber'])->name('getApnumber');



//Settings module
Route::get('/footer', [CompanySettingController::class, 'getCompanyDetails']);

// appointment setting
Route::get('/appointment-settings', [AppointmentSettingsController::class, 'index'])->name('apType.index');
Route::get('/appointment-settings/create', [AppointmentSettingsController::class, 'create'])->name('apType.create');
Route::delete('/appointment-type/{id}', [AppointmentSettingsController::class, 'destroy'])->name('apType.destroy');
Route::post('/store-appointment-type', [AppointmentSettingsController::class, 'store'])->name('apType.store');
Route::get('/appointment-settings/edit/{id}', [AppointmentSettingsController::class, 'edit'])->name('apType.edit');
Route::put('/store-appointment-type/update/{id}', [AppointmentSettingsController::class, 'update'])->name('apType.update');

Route::get('/settings/add-booking-info', [AppointmentSettingsController::class, 'addBookingInfo'])->name('addBookingInfo');
Route::post('/settings/save-booking-info', [AppointmentSettingsController::class, 'saveBookingInfo'])->name('saveBookingInfo');

// block dates
Route::get('/block-dates', [BlockedDateController::class, 'index'])->name('blockDates.index');
Route::post('/admin/blocked-dates/block', [BlockedDateController::class, 'blockDate'])->name('admin.blocked_dates.block');
Route::post('/admin/blocked-dates/unblock', [BlockedDateController::class, 'unblockDate'])->name('admin.blocked_dates.unblock');

// event settings
Route::get('/newevent/show', [EventController::class, 'index'])->name('event.index');
Route::get('/newevent/create', [EventController::class, 'create'])->name('event.create');
Route::post('/newevent/store', [EventController::class, 'store'])->name('event.store');
Route::delete('/newevent/delete/{id}', [EventController::class, 'destroy'])->name('event.destroy');
Route::get('/newevent/edit/{id}', [EventController::class, 'edit'])->name('event.edit');
Route::post('/newevent/update/{id}', [EventController::class, 'update'])->name('event.update');


//users
Route::resource('users', UserController::class);
Route::post('/users/add-user', [UserController::class, 'store'])->name('user.store');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('/editUser/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/updateUser/{id}', [UserController::class, 'update'])->name('updateUser');

//roles
Route::view('/role_edit', 'setting.roles.role_edit')->name('role_edit');
Route::post('/storeRole', [RoleController::class, 'storeRole'])->name('storeRole');
Route::get('/editRole/{id}', [RoleController::class, 'editRole'])->name('editRole');
Route::put('/updateRole/{id}', [RoleController::class, 'updateRole'])->name('updateRole');
Route::delete('/deleteRole/{id}', [RoleController::class, 'deleteRole'])->name('deleteRole');
Route::post('/assignRole', [RoleController::class, 'assignRole'])->name('assignRole');
Route::get('/addPermission', [RoleController::class, 'addPermission'])->name('addPermission');
Route::post('/storePermission', [RoleController::class, 'storePermission'])->name('storePermission');
Route::get('/showPermission', [RoleController::class, 'showPermission'])->name('showPermission');


//HR module
//attendance
Route::resource('attendance', AttendanceController::class);
Route::get('/attendance-list', [AttendanceController::class, 'show'])->name('show.employees');
Route::get('/hrm/attendance_list', [AttendanceController::class, 'show'])->name('attendance_list');
Route::get('/hrm/manage_attendance_list', [AttendanceController::class, 'manageAttendance'])->name('manage_attendance_list');
Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn'])->name('attendance.check-in');
Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut'])->name('attendance.check-out');
Route::get('/attendance/{id}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
Route::post('/attendance/{id}/update', [AttendanceController::class, 'update'])->name('attendance.update');
Route::view('/hrm/update_attendance', 'humanResources.attendance.update_attendance')->name('update_attendance');
Route::get('/hrm/attendance_reports', [AttendanceController::class, 'attendanceReport'])->name('attendance_reports');


//Leave
Route::resource('leave', LeaveController::class);
Route::post('/leave/update', [LeaveController::class, 'update'])->name('leave.update');
Route::get('/hrm/weekly_holidays', [LeaveController::class, 'show'])->name('weekly_holiday');
Route::get('/hrm/holiday', [LeaveController::class, 'showHolidays'])->name('holiday');
Route::get('/hrm/manage_holiday', [LeaveController::class, 'manageHolidays'])->name('manage_holiday');
Route::post('/holiday/store', [LeaveController::class, 'storeHolidays'])->name('holiday.store');
Route::delete('/holiday/{holiday}', [LeaveController::class, 'destroy'])->name('holiday.destroy');
Route::view('/hrm/weekly_holidays_update', 'humanResources.leave.weekly_holiday_update')->name('weekly_holiday_update');
Route::get('/holiday/{id}/edit', [LeaveController::class, 'edit'])->name('holiday.edit');
Route::post('/holiday/{id}/update', [LeaveController::class, 'updateHoliday'])->name('update_holiday');

Route::get('/hrm/add_leave_type', [LeaveController::class, 'showLeavetypes'])->name('add_leave_type');
Route::post('/hrm/add_leave_type/store', [LeaveController::class, 'storeLeavetypes'])->name('Leave_type.store');
Route::delete('/hrm/add_leave_type/{leave_type}', [LeaveController::class, 'destroyLeave_type'])->name('leave_type.destroy');
Route::post('/hrm/add_leave_type/{id}/update', [LeaveController::class, 'updateLeavetype'])->name('update_leave_type');
Route::get('/hrm/add_leave_type/{id}/edit', [LeaveController::class, 'editLeavetype'])->name('leave_type.edit');

Route::post('/hrm/leave_application/store', [LeaveController::class, 'storeleavApp'])->name('leave.store');
Route::get('/hrm/leave_application/apply', [LeaveController::class, 'createLeaveApp'])->name('apply_leave');
Route::get('/hrm/leave_application', [LeaveController::class, 'showLeaveApp'])->name('leave_application');
Route::get('/hrm/leave_application/manage', [LeaveController::class, 'manageLeaveApp'])->name('manage_leave_application');
Route::delete('/hrm/leave_application/{leave_application}', [LeaveController::class, 'destroyLeaveapp'])->name('leave_application.destroy');
Route::get('/hrm/leave-applications/edit/{id}', [LeaveController::class, 'editLeaveApp'])->name('leave_app_edit');
Route::put('/hrm/leave-applications/update/{id}', [LeaveController::class, 'updateLeaveApp'])->name('leave_app_update');


// API Routes for fetching items and stock
Route::get('/api/get-items/{supplierCode}', [App\Http\Controllers\OrderRequestContralller::class, 'getItemsBySupplier']);
Route::get('/api/get-item-stock/{itemCode}', [App\Http\Controllers\OrderRequestContralller::class, 'getItemStock']);


// routes/web.php
Route::get('/api/get-order-items/{orderRequestCode}', [GinController::class, 'getOrderItems']);
//POS

 Route::get('/pospage', [App\Http\Controllers\POSController::class, 'showHomepage'])->name('pospage');
 Route::post('/POS.store', [App\Http\Controllers\POSController::class, 'store'])->name('POS.store');
 Route::post('/POS.customerstore', [App\Http\Controllers\POSController::class, 'customerstore'])->name('POS.customerstore');
 Route::get('/showpos/{id}', [App\Http\Controllers\POSController::class, 'show'])->name('showopos');
 Route::delete('/deletepos/{id}', [App\Http\Controllers\POSController::class, 'destroy'])->name('deletepos');
 Route::get('/pos/print-and-redirect/{id}', [App\Http\Controllers\POSController::class, 'printAndRedirect'])->name('printAndRedirect');

// web.php
Route::get('/payment-result', [CustomerOrderController::class, 'handlePaymentResult'])->name('payment.result');


Route::post('/create-payment-order', [CustomerOrderController::class, 'createPaymentOrder'])->name('createPaymentOrder');
// Route::get('/payment-callback', [CustomerOrderController::class, 'handlePaymentCallback'])->name('payment.callback');
Route::get('/payment-result', [CustomerOrderController::class, 'paymentResult'])->name('paymentResult');

Route::post('/create-payment-booking', [BookingController::class, 'createPaymentBooking']);
// Route::get('/payment-booking-callback', [BookingController::class, 'handleBookingPaymentCallback'])->name('bpayment.callback');
Route::get('/payment-booking-result', [BookingController::class, 'paymentResult'])->name('bookingPaymentResult');


 //dashboard
 Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

 //revenue
 Route::get('/monthly-revenue', [RevenueController::class, 'index'])->name('monthly-revenue');
 Route::get('/api/monthly-revenue', [RevenueController::class, 'getMonthlyRevenue']);
 Route::get('/api/daily-revenue-column-chart', [RevenueController::class, 'getDailyRevenueForColumnChart']);

// customer module
Route::resource('customer', CustomerController::class);
Route::get('/allcustomers', [CustomerController::class,'index'])->name('allcustomers');
Route::get('/createCustomer', [CustomerController::class, 'create'])->name('createcustomer');
Route::post('/storeCustomer', [CustomerController::class, 'store'])->name('storecustomer');
Route::post('/verifyCustomer', [CustomerController::class, 'verify'])->name('verifycustomer');
Route::get('/editCustomer/{id}', [CustomerController::class, 'edit'])->name('editcustomer');
Route::post('/updateCustomer', [CustomerController::class, 'update'])->name('updatecustomer');
Route::delete('/deleteCustomer/{id}', [CustomerController::class, 'destroy'])->name('deletecustomer');
Route::post('/reverifyCustomer', [CustomerController::class, 'reverify'])->name('reverifycustomer');
Route::post('/resend-otp', [CustomerController::class, 'resendOtp'])->name('resendOtp');
Route::get('/treatmenthistory/{id}', [CustomerController::class, 'viewTreatmentHistory'])->name('viewTreatmentHistory');

Route::post('/password/update', [CustomerController::class, 'updatePassword'])->name('password.update');


//Treatment module
Route::get('/Treatment', [App\Http\Controllers\TreatmentController::class, 'index'])->name('Treatment');
Route::get('/createTreatment', [App\Http\Controllers\TreatmentController::class, 'create'])->name('createTreatment');
Route::get('/editTreatment/{id}', [App\Http\Controllers\TreatmentController::class, 'edit'])->name('editTreatment');
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
Route::get('/editItem/{id}', [ItemController::class, 'edit'])->name('edititem');
Route::put('/updateItem/{id}', [ItemController::class, 'update'])->name('updateitem');


// offer items
Route::get('/offer-items', [OfferItemsController::class, 'index'])->name('offerIndex');
Route::get('/offer-items/create', [OfferItemsController::class, 'create'])->name('offerCreate');
Route::post('/offer-items/store', [OfferItemsController::class, 'store'])->name('offerItemStore');
Route::get('/offer-items/edit/{id}', [OfferItemsController::class, 'edit'])->name('offerItemEdit');
Route::put('/offer-items/update/{id}', [OfferItemsController::class, 'update'])->name('offerItemUpdate');
Route::delete('/offer-items/destroy/{id}', [OfferItemsController::class, 'destroy'])->name('offerItemDestroy');

//OrderRequests module
Route::get('/allorderrequests', [App\Http\Controllers\OrderRequestContralller::class, 'index'])->name('allorderrequests');
Route::get('/createorderrequests', [App\Http\Controllers\OrderRequestContralller::class, 'create'])->name('OrderRequests.create');
Route::post('/insertorderrequests', [App\Http\Controllers\OrderRequestContralller::class, 'store'])->name('OrderRequests.store');
Route::get('/showorderrequests/{id}', [App\Http\Controllers\OrderRequestContralller::class, 'show'])->name('OrderRequests.show');
Route::delete('/deleteorderrequests/{id}', [App\Http\Controllers\OrderRequestContralller::class, 'destroy'])->name('OrderRequests.destroy');

// GIN
Route::get('/allgins', [App\Http\Controllers\GinController::class, 'index'])->name('allgins');
Route::get('/creategin', [App\Http\Controllers\GinController::class, 'create'])->name('creategin');
Route::post('/insertgin', [App\Http\Controllers\GinController::class, 'store'])->name('insertgin');
Route::get('/showogins/{id}', [App\Http\Controllers\GinController::class, 'show'])->name('showogins');
Route::delete('/deletegins/{id}', [App\Http\Controllers\GinController::class, 'destroy'])->name('deletegins');




Route::group(['middleware' => ['auth:admin','role:Super-Admin|Admin']], function () {
    
    Route::group(['middleware' => ['auth:admin','role:Super-Admin']], function () {
        Route::get('/customertreat/{id}', [App\Http\Controllers\TreatmentController::class, 'customerTreat'])->name('customerTreat');
    });
    

    //employee module
    Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');
    Route::get('/createemployee', [App\Http\Controllers\EmployeeController::class, 'create'])->name('createemployee');
    Route::get('/editemployee/{id}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('editemployee');
    Route::put('/updateemployee/{id}',[App\Http\Controllers\EmployeeController::class, 'update'])->name('updateemployee');
    Route::post('/storeemployee', [App\Http\Controllers\EmployeeController::class, 'store'])->name('storeemployee');
    Route::delete('/deleteemployee/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('deleteemployee');

    //reports
    Route::get('/orderreport', [App\Http\Controllers\ReportController::class, 'orderreport'])->name('orderreport');
    Route::get('/productreport', [App\Http\Controllers\ReportController::class, 'productreport'])->name('productreport');
    Route::get('/stockreport', [App\Http\Controllers\ReportController::class, 'stockreport'])->name('stockreport');
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
    Route::get('/custreatmentsreport', [App\Http\Controllers\ReportController::class, 'cusTreatmentsReport'])->name('cusTreatmentsReport');
    Route::get('/appointmentsreport', [App\Http\Controllers\ReportController::class, 'appointmentsReport'])->name('appointmentsReport');

    Route::post('/users/user-list', [UserController::class, 'show'])->name('user.show');
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/addRole', [RoleController::class, 'addRole'])->name('addRole');
    Route::get('/showRole', [RoleController::class, 'showRole'])->name('showRole');
    Route::get('/assign_user_role', [RoleController::class, 'showUsers'])->name('assign_user_role');
    Route::get('company-settings', [CompanySettingController::class, 'index'])->name('company.index');
    Route::post('company-settings', [CompanySettingController::class, 'store'])->name('company.store');
    
});

//dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


//revenue
Route::get('/monthly-revenue', [RevenueController::class, 'index'])->name('monthly-revenue');
Route::get('/api/monthly-revenue', [RevenueController::class, 'getMonthlyRevenue']);
Route::get('/api/daily-revenue-column-chart', [RevenueController::class, 'getDailyRevenueForColumnChart']);
