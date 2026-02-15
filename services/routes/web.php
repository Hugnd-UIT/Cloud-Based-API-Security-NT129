<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileApiController;
use App\Http\Controllers\SalaryApiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard/manager', function () {
    return view('manager.dashboard');
});

Route::get('/dashboard/employee', function () {
    return view('employee.dashboard');
});

Route::get('/roster', function() {
    return view('manager.roster');
});

Route::get('/payroll', function() {
    return view('manager.payroll');
});

// Sau khi có chức năng đăng nhập thì sửa lại đường dẫn cho chuẩn

Route::get('/profile/{manv}', [ProfileApiController::class, 'showProfile']);

Route::get('/salary/{manv}', [SalaryApiController::class, 'showSalary']);