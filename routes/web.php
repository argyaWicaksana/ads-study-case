<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UsersController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard.home');
    });

    Route::get('profile', fn() => view('dashboard.profile'))->name('profile');

    // Route::resource('users', UsersController::class);
    Route::resource('employees', EmployeeController::class);
});
