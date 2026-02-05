<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\User;
use Carbon\Carbon;

class DashboardApiController extends Controller
{
    public function index() {
        $time = Carbon::now();
        $month = $time->month;
        $year = $time->year;

        $tong_nhan_vien = Employee::where('TRANGTHAI', 1)->count();

        $tong_luong = Payroll::where('THANG', $month)->where('NAM', $year)->sum('TIENLUONGTL');

        $tong_thuong = Payroll::where('THANG', $month)->where('NAM', $year)->sum('TIENTHUONG');

        $tong_phat = Payroll::where('THANG', $month)->where('NAM', $year)->sum('TIENPHAT');
    
        $bieu_do_luong = Payroll::selectRaw('CONCAT(THANG, "/", NAM) as label, SUM(TIENLUONGTL) as value')
                                ->groupBy('NAM', 'THANG')
                                ->orderBy('NAM', 'asc') 
                                ->orderBy('THANG', 'asc')
                                ->limit(6)
                                ->get();

        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu thành công!',
            'data' => [
                'card_stats' => [
                    'tong_nhan_vien' => $tong_nhan_vien,
                    'tong_luong' => $tong_luong,
                    'tong_thuong' => $tong_thuong,
                    'tong_phat' => $tong_phat
                ],
                'chart_stats' => $bieu_do_luong
            ]
        ]);
    }
}