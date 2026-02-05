<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'TENDANGNHAP',
        'MATKHAU',
        'EMAIL',
        'QUYENHAN',
        'MANV'
    ];

    protected $hidden = [
        'MATKHAU',
        'TOKEN',
    ];

    protected function casts(): array
    {
        return [
            'EMAIL_VERIFY' => 'datetime',
            'MATKHAU' => 'hashed',
        ];
    }

    public function getAuthPassword()
    {
        return $this->MATKHAU;
    }

    public function employee() {
        return $this->belongsTo(Employee::class, 'MANV', 'MANV');
    }
}
