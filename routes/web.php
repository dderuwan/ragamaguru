<?php
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\OfferItemsController;
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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\TreatementController;

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

Route::get('lang/home', [LangController::class,'index']);
Route::get('lang/change', [LangController::class,'change'])->name('changeLang');


// Authentication Routes
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');


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



//Treatment module
Route::get('/Treatment', [App\Http\Controllers\TreatmentController::class, 'index'])->name('Treatment');
Route::get('/createTreatment', [App\Http\Controllers\TreatmentController::class, 'create'])->name('createTreatment');
Route::get('/editTreatment/{id}', [App\Http\Controllers\TreatmentController::class, 'edit'])->name('editTreatment');
Route::post('/updateTreatment',[App\Http\Controllers\TreatmentController::class, 'update'])->name('updateTreatment');
Route::post('/storeTreatment', [App\Http\Controllers\TreatmentController::class, 'store'])->name('storeTreatment');
Route::delete('/deleteTreatment/{id}', [App\Http\Controllers\TreatmentController::class, 'destroy'])->name('deleteTreatment');
Route::get('/customertreat/{id}', [App\Http\Controllers\TreatmentController::class, 'customerTreat'])->name('customerTreat');
Route::post('/savecustomertreatments/{id}', [App\Http\Controllers\TreatmentController::class, 'saveCustomerTreatments'])->name('saveCustomerTreatments');



//employee module
Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');
Route::get('/createemployee', [App\Http\Controllers\EmployeeController::class, 'create'])->name('createemployee');
Route::get('/editemployee/{id}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('editemployee');
Route::post('/updateemployee',[App\Http\Controllers\EmployeeController::class, 'update'])->name('updateemployee');
Route::post('/storeemployee', [App\Http\Controllers\EmployeeController::class, 'store'])->name('storeemployee');
Route::delete('/deleteemployee/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('deleteemployee');


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
Route::get('appointments/print-preview/{appointmentId}', [AppointmentsController::class, 'printPreview'])->name('appointments.printPreview');
Route::delete('/appointments/{id}', [AppointmentsController::class, 'destroy'])->name('appointments.destroy');

Route::get('/localbookings', [BookingController::class, 'indexLocal'])->name('bookings.indexLocal');
Route::get('/inbookings', [BookingController::class, 'indexInternational'])->name('bookings.indexInternational');
Route::get('/localbookings/date/{date}', [BookingController::class, 'getLocalBookingsByDate'])->name('localbookings.date');
Route::get('/intbookings/date/{date}', [BookingController::class, 'getIntBookingsByDate'])->name('intbookings.date');

// website appointment
Route::get('/customerappointments', [AppointmentsController::class, 'cusAppointmentCreate'])->name('cusAppointmentCreate');
Route::post('/check-date', [BookingController::class, 'checkDate'])->name('checkDate');
Route::post('/generate-otp', [BookingController::class, 'generateOtp'])->name('generate.otp');
Route::post('/verify-otp', [BookingController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/bookingstore', [BookingController::class, 'store'])->name('booking.store');



//Settings module
Route::get('company-settings', [CompanySettingController::class, 'index'])->name('company.index');
Route::post('company-settings', [CompanySettingController::class, 'store'])->name('company.store');

//users
Route::resource('users', UserController::class);
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::post('/users/add-user', [UserController::class, 'store'])->name('user.store');
Route::post('/users/user-list', [UserController::class, 'show'])->name('user.show');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('/editUser/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/updateUser/{id}', [UserController::class, 'update'])->name('updateUser');

//roles
Route::view('/add_role', 'setting.roles.add_roles')->name('add_roles');
Route::view('/role_list', 'setting.roles.role_list')->name('role_list');
Route::view('/role_edit', 'setting.roles.role_edit')->name('role_edit');
Route::get('/assign_user_role', [RoleController::class, 'showUsers'])->name('assign_user_role');


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



 //dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//revenue
Route::get('/monthly-revenue', [RevenueController::class, 'index'])->name('monthly-revenue');
Route::get('/api/monthly-revenue', [RevenueController::class, 'getMonthlyRevenue']);
Route::get('/api/daily-revenue-column-chart', [RevenueController::class, 'getDailyRevenueForColumnChart']);










?>




