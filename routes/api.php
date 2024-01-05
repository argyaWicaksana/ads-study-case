<?php

use App\Http\Controllers\AuthSanctumController;
use App\Http\Controllers\EmployeeApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthSanctumController::class, 'logout']);
    Route::apiResource('employees', EmployeeApiController::class);
    Route::get('old-employees', [EmployeeApiController::class, 'oldEmployee']);
    Route::get('employee-leave', [EmployeeApiController::class, 'leaveEmployee']);
    Route::get('employee-ever-leave', [EmployeeApiController::class, 'employeeEverLeave']);
});

Route::post('login', [AuthSanctumController::class, 'login']);
