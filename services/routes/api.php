<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardApiController;
use App\Http\Controllers\PayrollApiController;
use App\Http\Controllers\RosterApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/dashboard/manager', [DashboardApiController::class, 'get_manager_data']);

Route::get('/dashboard/employee', [DashboardApiController::class, 'get_employee_data']);

Route::get('/payroll', [PayrollApiController::class, 'index']);

Route::get('/roster', [RosterApiController::class, 'index']);

Route::post('/roster', [RosterApiController::class, 'store']);

Route::get('/roster/{id}', [RosterApiController::class, 'show']);

Route::put('/roster/{id}', [RosterApiController::class, 'update']);

Route::delete('/roster/{id}', [RosterApiController::class, 'destroy']);