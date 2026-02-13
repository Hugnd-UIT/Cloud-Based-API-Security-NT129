<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ nhân viên | HR System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
@if(!$employee)
    <div class="p-8 text-center">
        <h2 class="text-xl font-bold text-red-600">Chưa có thông tin hồ sơ</h2>
        <p>Tài khoản này chưa được liên kết với mã nhân viên nào trong hệ thống.</p>
        <p class="mt-2 text-sm text-gray-500">Vui lòng liên hệ bộ phận kỹ thuật.</p>
    </div>
@else
    @endif
<body class="bg-gray-100 text-slate-800 font-sans">

    <div class="min-h-screen flex flex-col">
        <nav class="bg-white shadow-sm border-b px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-blue-600 tracking-wide">HR SYSTEM</h1>
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-gray-600">Xin chào, {{ $user->TENDANGNHAP }}</span>
                <form action="/logout" method="POST">
                    @csrf
                    <button class="text-red-500 hover:text-red-700 text-sm font-bold">Đăng xuất</button>
                </form>
            </div>
        </nav>

        <main class="flex-grow container mx-auto px-4 py-8">
            
            <div class="max-w-5xl mx-auto">
                <div class="mb-6 flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-800">Hồ sơ cá nhân</h2>
                    @if($user->employee)
                        <span class="px-4 py-1 rounded-full text-xs font-bold uppercase tracking-wider 
                            {{ $user->employee->TRANGTHAI == 'Đang làm việc' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                            {{ $user->employee->TRANGTHAI ?? 'Không xác định' }}
                        </span>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <div class="md:col-span-1">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden relative">
                            <div class="h-24 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                            <div class="px-6 pb-6 text-center relative">
                                <div class="w-24 h-24 rounded-full bg-white p-1 mx-auto -mt-12 shadow-md">
                                    <div class="w-full h-full rounded-full bg-slate-200 flex items-center justify-center text-3xl font-bold text-slate-500">
                                        {{ substr($user->employee->HOTEN ?? $user->TENDANGNHAP, 0, 1) }}
                                    </div>
                                </div>
                                
                                <h3 class="mt-3 text-xl font-bold text-gray-800">
                                    {{ $user->employee->HOTEN ?? 'Chưa cập nhật tên' }}
                                </h3>
                                <p class="text-sm text-gray-500 mb-4">{{ $user->employee->CHUCVU ?? $user->QUYENHAN }}</p>
                                
                                <div class="border-t pt-4 text-left space-y-3">
                                    <div class="flex items-center text-sm">
                                        <i class="fa-regular fa-envelope w-6 text-gray-400"></i>
                                        <span class="truncate" title="{{ $user->EMAIL }}">{{ $user->EMAIL }}</span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <i class="fa-solid fa-id-badge w-6 text-gray-400"></i>
                                        <span>MSNV: <strong>{{ $user->MANV ?? '---' }}</strong></span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <i class="fa-solid fa-phone w-6 text-gray-400"></i>
                                        <span>{{ $user->employee->SDT ?? 'Chưa có SĐT' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 bg-white rounded-xl shadow-lg p-6">
                            <h4 class="font-bold text-gray-700 mb-4">Thông tin hợp đồng</h4>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-500">Ngày vào làm</span>
                                <span class="font-medium text-sm">
                                    {{ isset($user->employee->NGAYVAOLAM) ? \Carbon\Carbon::parse($user->employee->NGAYVAOLAM)->format('d/m/Y') : '---' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2 space-y-6">
                        
                        @if(!$user->employee)
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fa-solid fa-triangle-exclamation text-yellow-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        Tài khoản <strong>{{ $user->TENDANGNHAP }}</strong> chưa được liên kết với hồ sơ nhân viên nào.
                                        Vui lòng liên hệ Admin để cập nhật thông tin chi tiết.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        
                        <div class="bg-white rounded-xl shadow-lg p-8">
                            <div class="flex items-center mb-6 pb-2 border-b">
                                <i class="fa-regular fa-user text-blue-500 mr-2"></i>
                                <h3 class="text-lg font-bold text-gray-800 uppercase">Thông tin cá nhân</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Họ và tên</label>
                                    <div class="text-gray-900 font-medium">{{ $user->employee->HOTEN }}</div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Giới tính</label>
                                    <div class="text-gray-900 font-medium">
                                        @if($user->employee->GIOITINH == 'Nam')
                                            <span class="text-blue-600"><i class="fa-solid fa-mars"></i> Nam</span>
                                        @elseif($user->employee->GIOITINH == 'Nu')
                                            <span class="text-pink-600"><i class="fa-solid fa-venus"></i> Nữ</span>
                                        @else
                                            {{ $user->employee->GIOITINH }}
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Ngày sinh</label>
                                    <div class="text-gray-900 font-medium">
                                        {{ \Carbon\Carbon::parse($user->employee->NGAYSINH)->format('d/m/Y') }}
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Số CCCD/CMND</label>
                                    <div class="text-gray-900 font-medium">{{ $user->employee->CCCD }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg p-8">
                            <div class="flex items-center mb-6 pb-2 border-b">
                                <i class="fa-solid fa-briefcase text-blue-500 mr-2"></i>
                                <h3 class="text-lg font-bold text-gray-800 uppercase">Thông tin công việc</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Chức vụ</label>
                                    <div class="text-gray-900 font-medium">{{ $user->employee->CHUCVU }}</div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Phòng ban</label>
                                    <div class="text-gray-900 font-medium">Phòng Kỹ Thuật (Demo)</div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Trạng thái làm việc</label>
                                    <div class="text-gray-900 font-medium">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->employee->TRANGTHAI == 'Đang làm việc' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $user->employee->TRANGTHAI }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>