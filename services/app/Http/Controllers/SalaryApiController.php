<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class SalaryApiController extends Controller
{
    public function showSalary($manv)
    {
        $employee = Employee::with(['salaries' => function($query) {
            $query->orderBy('NAM', 'desc')->orderBy('THANG', 'desc');
        }])
        ->where('MANV', $manv)
        ->firstOrFail();

        return view('employee.salary', [
            'employee' => $employee,
            'payrolls' => $employee->salaries 
        ]);
    }
}