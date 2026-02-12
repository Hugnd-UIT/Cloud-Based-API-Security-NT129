<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Payroll;
use Carbon\Carbon;

class DashboardApiController extends Controller
{
    public function index() {
        $current_time = Carbon::now();
        $current_month = $current_time->month;
        $current_year = $current_time->year;

        $total_employees = Employee::where('TRANGTHAI', 1)->count();

        $total_salary = Payroll::where('THANG', $current_month)->where('NAM', $current_year)->sum('TIENLUONGTL');

        $total_bonus = Payroll::where('THANG', $current_month)->where('NAM', $current_year)->sum('TIENTHUONG');

        $total_fine = Payroll::where('THANG', $current_month)->where('NAM', $current_year)->sum('TIENPHAT');
    
        $chart_data = Payroll::selectRaw('CONCAT(THANG, "/", NAM) as label, SUM(TIENLUONGTL) as value')
                                ->groupBy('NAM', 'THANG')
                                ->orderBy('NAM', 'asc') 
                                ->orderBy('THANG', 'asc')
                                ->limit(6)
                                ->get();

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => [
                'card_stats' => [
                    'total_employees' => $total_employees,
                    'total_salary' => $total_salary,
                    'total_bonus' => $total_bonus,
                    'total_fine' => $total_fine
                ],
                'chart_stats' => $chart_data
            ]
        ]);
    }
}