<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'MANV', 'HOTEN', 'NGAYSINH', 'GIOITINH',
        'CCCD', 'SDT', 'CHUCVU', 'NGAYVAOLAM', 'TRANGTHAI'
    ];

    public function salaries() {
        return $this->hasMany(Payroll::class, 'MANV', 'MANV')
                    ->orderBy('NAM', 'desc')
                    ->orderBy('THANG', 'desc'); 
    }

    public function user() {
        return $this->hasOne(User::class, 'MANV', 'MANV');
    }

}