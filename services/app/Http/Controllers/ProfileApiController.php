<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class ProfileApiController extends Controller
{

    public function showProfile($manv)
    {
        $employee = Employee::where('MANV', $manv)->first();

        if (!$employee) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy nhân viên này trên hệ thống!'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $employee
        ]);
    }
}