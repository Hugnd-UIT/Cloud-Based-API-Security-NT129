<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('manager.dashboard');
});

Route::get('/roster', function() {
    return view('manager.roster');
});

Route::get('/payroll', function() {
    return view('manager.payroll');
});

Route::get('/login', function() {
    return view('auth.login');
});

use App\Http\Controllers\ProfileApiController;

Route::middleware(['auth'])->group(function () {
    
    // Route xem hồ sơ của tôi (Click từ menu)
    Route::get('/my-profile', [ProfileApiController::class, 'myProfile'])->name('profile.me');

    // Route xem chi tiết nhân viên (Có tham số manv)
    // Ví dụ: domain.com/profile/NV001
    Route::get('/profile/{manv}', [ProfileApiController::class, 'show'])->name('profile.show');

});