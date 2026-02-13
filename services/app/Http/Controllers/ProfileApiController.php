<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class ProfileApiController extends Controller
{
    // 1. Xem hồ sơ của chính mình (My Profile)
    public function myProfile()
    {
        $user = Auth::user();
        
        // Nếu user chưa liên kết nhân viên -> Báo lỗi hoặc hướng dẫn
        if (!$user->MANV) {
            return view('employee.profile', ['employee' => null, 'user' => $user]);
        }

        // Chuyển hướng sang hàm show để tái sử dụng code
        return redirect()->route('profile.show', ['manv' => $user->MANV]);
    }

    // 2. Xem chi tiết hồ sơ (Dùng chung cho cả HR và NV)
    public function show($manv)
    {
        $currentUser = Auth::user();

        // --- BẢO MẬT (AUTHORIZATION) ---
        // Nếu User hiện tại KHÔNG PHẢI HR và ĐANG CỐ XEM người khác
        if ($currentUser->QUYENHAN !== 'HR' && $currentUser->MANV !== $manv) {
            abort(403, 'Bạn không có quyền xem thông tin của nhân viên khác.');
        }

        // Lấy thông tin nhân viên + Bảng lương
        $employee = Employee::with('salaries')
                    ->where('MANV', $manv)
                    ->firstOrFail(); // Nếu không thấy thì báo lỗi 404

        return view('employee.profile', [
            'employee' => $employee,
            'currentUser' => $currentUser // Truyền user hiện tại để check quyền ẩn/hiện nút
        ]);
    }
}