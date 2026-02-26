<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileApiController;
use App\Http\Controllers\SalaryApiController;
use App\Http\Controllers\DashboardApiController; 

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('manager/{manv}')->group(function () {
    Route::get('/dashboard', function ($manv) {
        $manager = \App\Models\Employee::where('MANV', $manv)->first();
        return view('manager.dashboard', [
            'manv' => $manv, 
            'manager' => $manager
        ]);
    });
    Route::get('/roster', function ($manv) {
        return view('manager.roster', ['manv' => $manv]);
    });
    Route::get('/payroll', function ($manv) {
        return view('manager.payroll', ['manv' => $manv]);
    });
    Route::get('/profile', [ProfileApiController::class, 'showProfile']);
});

Route::prefix('employee/{manv}')->group(function () {
    Route::get('/dashboard', function ($manv) {
        $employee = \App\Models\Employee::where('MANV', $manv)->first();
        
        return view('employee.dashboard', [
            'manv' => $manv, 
            'employee' => $employee
        ]);
    });

    Route::get('/salary', [SalaryApiController::class, 'showSalary']);
    Route::get('/profile', [ProfileApiController::class, 'showProfile']);
});

Route::get('/api/dashboard/manager-data', [DashboardApiController::class, 'get_manager_data']);
Route::get('/api/dashboard/employee-data', [DashboardApiController::class, 'get_employee_data']);