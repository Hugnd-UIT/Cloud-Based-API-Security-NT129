<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class ProfileApiController extends Controller
{

    public function showProfile($manv)
    {
        $employee = Employee::where('MANV', $manv)->firstOrFail();
        return view('employee.profile', [
            'employee' => $employee,
            'user' => $employee 
        ]);
    }

}