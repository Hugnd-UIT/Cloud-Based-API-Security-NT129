<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees'; // Đảm bảo tên bảng đúng trong DB của bạn

    // CẤU HÌNH QUAN TRỌNG
    protected $primaryKey = 'MANV'; // Khóa chính là MANV
    public $incrementing = false;   // Tắt tự tăng ID
    protected $keyType = 'string';  // Kiểu dữ liệu chuỗi

    protected $fillable = [
        'MANV', 'HOTEN', 'NGAYSINH', 'GIOITINH',
        'CCCD', 'SDT', 'CHUCVU', 'NGAYVAOLAM', 'TRANGTHAI'
    ];

    // Quan hệ với bảng Lương
    public function salaries() {
        // Sắp xếp lương mới nhất lên đầu
        return $this->hasMany(Payroll::class, 'MANV', 'MANV')
                    ->orderBy('NAM', 'desc')
                    ->orderBy('THANG', 'desc'); 
    }

    public function user() {
        return $this->hasOne(User::class, 'MANV', 'MANV');
    }

}