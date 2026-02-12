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