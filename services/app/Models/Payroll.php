<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'MANV',
        'THANG',
        'NAM',
        'TIENPHAT',
        'TIENLUONGCB',
        'TIENTHUONG',
        'TIENLUONGTL',
        'SONGAYCONG'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class, 'MANV', 'MANV');
    }
}
