<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
})->name('/');


// Guest Users
Route::middleware(['guest', 'PreventBackHistory', 'firewall.all'])->group(function () {
    Route::get('login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('signin');
    Route::get('register', [App\Http\Controllers\Admin\AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [App\Http\Controllers\Admin\AuthController::class, 'register'])->name('signup');
});




// Authenticated users
Route::middleware(['auth', 'PreventBackHistory', 'firewall.all'])->group(function () {

    // Auth Routes
    Route::get('home', fn () => redirect()->route('dashboard'))->name('home');
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [App\Http\Controllers\Admin\AuthController::class, 'Logout'])->name('logout');
    Route::get('change-theme-mode', [App\Http\Controllers\Admin\DashboardController::class, 'changeThemeMode'])->name('change-theme-mode');
    Route::get('show-change-password', [App\Http\Controllers\Admin\AuthController::class, 'showChangePassword'])->name('show-change-password');
    Route::post('change-password', [App\Http\Controllers\Admin\AuthController::class, 'changePassword'])->name('change-password');



    // Masters
    Route::resource('wards', App\Http\Controllers\Admin\Masters\WardController::class);
    Route::resource('propertytype', App\Http\Controllers\Admin\Masters\PropertyTypeController::class);
    Route::resource('property', App\Http\Controllers\Admin\Masters\PropertyController::class);
    Route::resource('department', App\Http\Controllers\Admin\Masters\DepartmentController::class);
    Route::resource('slot', App\Http\Controllers\Admin\Masters\SlotController::class);
    Route::resource('propertydetails',App\Http\Controllers\Admin\Masters\PropertyDetailsController::class);

    // Slot Booking
    Route::resource('slotbooking', App\Http\Controllers\Admin\SlotBookingController::class);
    Route::get('fetchproperty', [App\Http\Controllers\Admin\SlotBookingController::class, 'propertynamefetch'])->name('fetchproperty');
    Route::get('fetchamount', [App\Http\Controllers\Admin\SlotBookingController::class, 'amount_fetch'])->name('fetchamount');
    Route::get('fetchaddress', [App\Http\Controllers\Admin\SlotBookingController::class, 'fetch_address'])->name('fetchaddress');

    //Ward login clerk and Department clerk
    Route::get('pendinglist', [App\Http\Controllers\Admin\ListingController::class, 'pending_list'])->name('pendinglist');
    Route::get('approvelist', [App\Http\Controllers\Admin\ListingController::class, 'approve_list'])->name('approvelist');
    Route::get('returnlist', [App\Http\Controllers\Admin\ListingController::class, 'return_list'])->name('returnlist');
    Route::get('get-slot-details/{id}', [App\Http\Controllers\Admin\ListingController::class, 'getSlotDetails']);



    Route::post('/approvedslot', [App\Http\Controllers\Admin\ListingController::class, 'approved_slot'])->name('approvedslot');
    Route::post('/returnslot', [App\Http\Controllers\Admin\ListingController::class, 'return_slot'])->name('returnslot');




    // Users Roles n Permissions
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::get('users/{user}/toggle', [App\Http\Controllers\Admin\UserController::class, 'toggle'])->name('users.toggle');
    Route::get('users/{user}/retire', [App\Http\Controllers\Admin\UserController::class, 'retire'])->name('users.retire');
    Route::put('users/{user}/change-password', [App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('users.change-password');
    Route::get('users/{user}/get-role', [App\Http\Controllers\Admin\UserController::class, 'getRole'])->name('users.get-role');
    Route::put('users/{user}/assign-role', [App\Http\Controllers\Admin\UserController::class, 'assignRole'])->name('users.assign-role');
    Route::get('fetchdepartment', [App\Http\Controllers\Admin\UserController::class, 'departmentfetch'])->name('fetchdepartment');
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
});




Route::get('/php', function (Request $request) {
    if (!auth()->check())
        return 'Unauthorized request';

    Artisan::call($request->artisan);
    return dd(Artisan::output());
});
