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
    Route::get('/profile', function ($manv) {
        return view('profile'); 
    });
});

Route::prefix('employee/{manv}')->group(function () {
    Route::get('/dashboard', function ($manv) {
        $employee = \App\Models\Employee::where('MANV', $manv)->first();
        
        return view('employee.dashboard', [
            'manv' => $manv, 
            'employee' => $employee
        ]);
    });
    Route::get('/salary', function ($manv) {
        return view('employee.salary');
    });
    Route::get('/profile', function ($manv) {
        return view('profile');
    });
});