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
        ->first();

        if (!$employee) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy dữ liệu lương của nhân viên này!'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'employee' => $employee,
                'payrolls' => $employee->salaries
            ]
        ]);
    }
}