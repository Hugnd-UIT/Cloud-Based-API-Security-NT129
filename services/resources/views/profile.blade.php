@extends('layouts.master')

@section('title', 'Hồ sơ nhân viên - PayShield')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="h-32 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 relative">
            <i class="fas fa-id-card absolute right-10 bottom-[-20px] text-8xl text-white opacity-10 transform -rotate-12"></i>
        </div>
        
        <div class="px-8 pb-8 relative flex flex-col sm:flex-row gap-6 items-start sm:items-end -mt-12">
            <div class="relative rounded-full p-1 bg-white shadow-md inline-block">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->HOTEN ?? 'NV') }}&background=eff6ff&color=2563eb&size=120&bold=true" alt="Avatar" class="w-24 h-24 sm:w-28 sm:h-28 rounded-full border-4 border-white object-cover">
            </div>
            
            <div class="flex-1 mb-2">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">{{ $employee->HOTEN }}</h2>
                <p class="text-blue-600 font-medium mt-1 flex items-center gap-2">
                    <i class="fas fa-briefcase"></i> {{ $employee->CHUCVU ?? 'Chưa cập nhật' }}
                </p>
            </div>
            
            <div class="mb-4 sm:mb-2">
                @if($employee->TRANGTHAI == 1)
                    <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-emerald-50 text-emerald-600 text-sm font-bold border border-emerald-100 shadow-sm">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Đang làm việc
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-rose-50 text-rose-600 text-sm font-bold border border-rose-100 shadow-sm">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                        Đã nghỉ việc
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
            <div class="bg-blue-100 text-blue-600 w-8 h-8 rounded-lg flex items-center justify-center">
                <i class="fas fa-user-check text-sm"></i>
            </div>
            Thông tin định danh & Liên hệ
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <div class="p-4 rounded-xl border border-gray-100 bg-gray-50/50 hover:bg-white hover:shadow-md hover:border-blue-200 transition duration-300 group">
                <p class="text-sm font-medium text-gray-500 mb-1 flex items-center gap-2">
                    <i class="fas fa-fingerprint text-gray-400 group-hover:text-blue-500 transition"></i> Mã nhân viên
                </p>
                <p class="text-lg font-bold text-gray-800">{{ $employee->MANV }}</p>
            </div>

            <div class="p-4 rounded-xl border border-gray-100 bg-gray-50/50 hover:bg-white hover:shadow-md hover:border-blue-200 transition duration-300 group">
                <p class="text-sm font-medium text-gray-500 mb-1 flex items-center gap-2">
                    <i class="fas fa-birthday-cake text-gray-400 group-hover:text-blue-500 transition"></i> Ngày sinh
                </p>
                <p class="text-lg font-bold text-gray-800">
                    {{ isset($employee->NGAYSINH) ? \Carbon\Carbon::parse($employee->NGAYSINH)->format('d/m/Y') : '--' }}
                </p>
            </div>

            <div class="p-4 rounded-xl border border-gray-100 bg-gray-50/50 hover:bg-white hover:shadow-md hover:border-blue-200 transition duration-300 group">
                <p class="text-sm font-medium text-gray-500 mb-1 flex items-center gap-2">
                    <i class="fas fa-venus-mars text-gray-400 group-hover:text-blue-500 transition"></i> Giới tính
                </p>
                <p class="text-lg font-bold text-gray-800">{{ $employee->GIOITINH ?? '--' }}</p>
            </div>

            <div class="p-4 rounded-xl border border-gray-100 bg-gray-50/50 hover:bg-white hover:shadow-md hover:border-blue-200 transition duration-300 group">
                <p class="text-sm font-medium text-gray-500 mb-1 flex items-center gap-2">
                    <i class="fas fa-id-card-alt text-gray-400 group-hover:text-blue-500 transition"></i> Số CCCD
                </p>
                <p class="text-lg font-bold text-gray-800">{{ $employee->CCCD ?? '--' }}</p>
            </div>

            <div class="p-4 rounded-xl border border-gray-100 bg-gray-50/50 hover:bg-white hover:shadow-md hover:border-blue-200 transition duration-300 group">
                <p class="text-sm font-medium text-gray-500 mb-1 flex items-center gap-2">
                    <i class="fas fa-phone-alt text-gray-400 group-hover:text-blue-500 transition"></i> Số điện thoại
                </p>
                <p class="text-lg font-bold text-gray-800">{{ $employee->SDT ?? '--' }}</p>
            </div>

            <div class="p-4 rounded-xl border border-gray-100 bg-gray-50/50 hover:bg-white hover:shadow-md hover:border-blue-200 transition duration-300 group">
                <p class="text-sm font-medium text-gray-500 mb-1 flex items-center gap-2">
                    <i class="fas fa-calendar-check text-gray-400 group-hover:text-blue-500 transition"></i> Ngày vào làm
                </p>
                <p class="text-lg font-bold text-gray-800">
                    {{ isset($employee->NGAYVAOLAM) ? \Carbon\Carbon::parse($employee->NGAYVAOLAM)->format('d/m/Y') : '--' }}
                </p>
            </div>

        </div>
    </div>
</div>
@endsection