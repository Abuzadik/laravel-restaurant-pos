<?php

use App\Http\Controllers\expense\statsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

//admins permision route
Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('', function () {
        return view('admin.admin_dashboard');
    });
    //user register auth
    Route::get('/register', function () {
        return view('auth.login');
    });
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //sales and report routes
    Route::get('/sales', [App\Http\Controllers\sales\reportController::class,'index'])->name('sales');
    Route::get('/sales/DateRange', [App\Http\Controllers\sales\reportController::class,'DateRange'])->name('sales.DateRange');
    Route::get('/sales/status', [App\Http\Controllers\sales\reportController::class,'saleStatus'])->name('sales.saleStatus');
    Route::get('/sales/allSales', [App\Http\Controllers\sales\reportController::class,'allSales'])->name('sales.allSales');

    //expenses Route
    Route::resource('/expenses', App\Http\Controllers\expense\expenseController::class);
    Route::get('/exp/status', [App\Http\Controllers\expense\statsController::class,'index'])->name('expenses.status');
    Route::get('/exp/daterange', [App\Http\Controllers\expense\expenseDateRangeController::class,'index'])->name('expense.daterange');

    //general Route
    Route::get('/general', [App\Http\Controllers\general\generalController::class,'index'])->name('general');
    Route::resource('/general/usernames', App\Http\Controllers\general\userController::class);
    // Route::get('/general/profile', [App\Http\Controllers\general\profileController::class,'index'])->name('general.profile');
    // Route::post('general/profile/change-password', [App\Http\Controllers\general\profileController::class ,'changePassword'])->name('change.password');

    //tax routes
    Route::get('/tax', [App\Http\Controllers\tax\taxController::class,'index'])->name('tax');
    Route::get('/tax/daterange', [App\Http\Controllers\tax\taxController::class,'taxDateRange'])->name('tax.daterange');

    //system -- restaurant name 
    Route::resource('/general/system', App\Http\Controllers\system\systemController::class);

});

//Restaurant setup Route 
Route::get('/admin/restaurant', [App\Http\Controllers\admin\restaurantController::class,'AdminRestaurant'])->name('restaurant');
// Route::get('/restaurant/category', [App\Http\Controllers\admin\categoryController::class,'index'])->name('category');
Route::resource('/admin/restaurant/category', App\Http\Controllers\admin\categoryController::class);
Route::resource('/admin/restaurant/foodmenu', App\Http\Controllers\admin\foodmenuController::class);
Route::resource('/admin/restaurant/table', App\Http\Controllers\admin\tableController::class);

//users
Route::get('/user/dashboard', [App\Http\Controllers\user\userController::class, 'UserDashboard'])->name('user.dashboard');
//every user profile
Route::get('/general/profile', [App\Http\Controllers\general\profileController::class,'index'])->name('general.profile');
Route::post('general/profile/change-password', [App\Http\Controllers\general\profileController::class ,'changePassword'])->name('change.password');


//pos
Route::get('/pos',[App\Http\Controllers\pos\posController::class,'index'])->name('pos');
Route::get('/pos/getTable', [App\Http\Controllers\pos\posController::class,'getTable']);
Route::get('/pos/getMenuByCategory/{category_id}', [App\Http\Controllers\pos\posController::class,'getMenuByCats']);
Route::get('/pos/allMenus', [App\Http\Controllers\pos\posController::class,'allMenus'])->name('pos.allmenus');
Route::post('/pos/orderMenu', [App\Http\Controllers\pos\posController::class,'orderMenu']);
Route::get('/pos/getSaleDetailsByTable/{table_id}', [App\Http\Controllers\pos\posController::class,'getSaleDetailsByTable']); 
Route::post('/pos/confirmOrderStatus', [App\Http\Controllers\pos\posController::class,'confirmOrderStatus']); 
Route::post('/pos/deleteSaleDetail', [App\Http\Controllers\pos\posController::class,'deleteSaleDetail']);
Route::post('/pos/savePayment', [App\Http\Controllers\pos\posController::class,'savePayment']);
Route::get('/pos/printReceipt/{saleID}', [App\Http\Controllers\pos\posController::class,'showReceipt']);


//datatable example 
// Route::get('/admin/datatable', [App\Http\Controllers\DatatableController::class,'index'])->name('datatable');

// //test modal
// Route::get('/pos/test', [App\Http\Controllers\pos\testController::class,'index']);

//testdate picker
// Route::get('/sales/test' , [App\Http\Controllers\TestDateCon::class,'index']);










