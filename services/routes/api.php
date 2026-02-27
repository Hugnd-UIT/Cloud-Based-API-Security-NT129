<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardApiController;
use App\Http\Controllers\PayrollApiController;
use App\Http\Controllers\RosterApiController;
use App\Http\Controllers\ProfileApiController;
use App\Http\Controllers\SalaryApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/payrolls', [PayrollApiController::class, 'index']);

Route::get('/employees', [RosterApiController::class, 'index']);

Route::post('/employees', [RosterApiController::class, 'store']);

Route::get('/employees/{id}', [RosterApiController::class, 'show']);

Route::put('/employees/{id}', [RosterApiController::class, 'update']);

Route::delete('/employees/{id}', [RosterApiController::class, 'destroy']);

Route::get('/profile/{manv}', [ProfileApiController::class, 'showProfile']);

Route::get('dashboard/manager-data', [DashboardApiController::class, 'get_manager_data']);

Route::get('dashboard/employee-data', [DashboardApiController::class, 'get_employee_data']);

Route::get('/salary/{manv}', [SalaryApiController::class, 'showSalary']);