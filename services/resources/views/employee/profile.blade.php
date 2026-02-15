<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ nhân sự | PayShield Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-[#f8fafc] text-[#1e293b]">

    <nav class="sticky top-0 z-50 w-full border-b border-slate-200 bg-white/70 backdrop-blur-md">
        <div class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                    <i class="fa-solid fa-id-card-clip text-white text-lg"></i>
                </div>
                <span class="font-extrabold text-xl tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-violet-600">
                    PayShield <span class="text-slate-400 font-light">Personnel</span>
                </span>
            </div>
            <a href="/salary/{{ $employee->MANV }}" class="group flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-full text-sm font-bold hover:bg-indigo-600 transition-all duration-300 shadow-md">
                <span>Tra cứu thu nhập</span>
                <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-10">
        <div class="relative mb-10">
            <div class="h-48 w-full bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-[2rem] shadow-2xl opacity-90"></div>
            
            <div class="absolute -bottom-8 left-8 flex flex-col md:flex-row items-end gap-6 px-4">
                <div class="h-32 w-32 bg-white rounded-[2.5rem] p-2 shadow-xl relative group">
                    <div class="h-full w-full bg-slate-100 rounded-[2rem] flex items-center justify-center text-4xl font-black text-indigo-600 overflow-hidden">
                        {{ substr($employee->HOTEN, 0, 1) }}
                    </div>
                    <div class="absolute bottom-1 right-1 h-8 w-8 bg-emerald-500 border-4 border-white rounded-full flex items-center justify-center" title="Đang làm việc">
                        <i class="fa-solid fa-check text-[10px] text-white"></i>
                    </div>
                </div>
                <div class="mb-2">
                    <h1 class="text-3xl font-extrabold text-slate-900 leading-none mb-2">{{ $employee->HOTEN }}</h1>
                    <div class="flex flex-wrap gap-2 items-center text-slate-500 font-medium">
                        <span class="bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full text-xs font-bold">{{ $employee->CHUCVU }}</span>
                        <span class="text-slate-300">•</span>
                        <span class="text-sm">Mã nhân viên: <b class="text-slate-700">{{ $employee->MANV }}</b></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-16">
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                    <h3 class="text-sm font-bold uppercase tracking-[0.2em] text-slate-400 mb-6">Liên hệ nhanh</h3>
                    <div class="space-y-5">
                        <div class="flex items-center gap-4 group">
                            <div class="h-10 w-10 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-colors">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase">Số điện thoại</p>
                                <p class="font-bold text-slate-700">{{ $employee->SDT ?? 'Chưa cung cấp' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 group">
                            <div class="h-10 w-10 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-colors">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase">Email nội bộ</p>
                                <p class="font-bold text-slate-700">{{ strtolower($employee->MANV) }}@payshield.com</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-emerald-50 p-6 rounded-[2rem] border border-emerald-100 relative overflow-hidden group">
                    <i class="fa-solid fa-shield-halved absolute -right-4 -bottom-4 text-8xl text-emerald-100/50 group-hover:rotate-12 transition-transform"></i>
                    <h3 class="text-emerald-700 font-bold mb-1">Trạng thái hồ sơ</h3>
                    <p class="text-emerald-600 text-sm font-medium mb-4">Hồ sơ đã được xác minh trên hệ thống PayShield.</p>
                    <div class="inline-flex items-center gap-2 bg-white px-3 py-1 rounded-full text-[10px] font-extrabold text-emerald-600 shadow-sm">
                        <span class="h-2 w-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        {{ $employee->TRANGTHAI }}
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden">
                    <div class="flex justify-between items-center mb-10">
                        <h3 class="text-xl font-extrabold text-slate-800">Thông tin chi tiết</h3>
                        <div class="h-px flex-grow mx-6 bg-slate-100"></div>
                        <i class="fa-solid fa-user-gear text-slate-200 text-2xl"></i>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-10 gap-x-12">
                        <div class="relative">
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-2">Họ và tên</p>
                            <p class="text-lg font-bold text-slate-700">{{ $employee->HOTEN }}</p>
                        </div>
                        <div class="relative">
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-2">Ngày sinh</p>
                            <p class="text-lg font-bold text-slate-700">{{ \Carbon\Carbon::parse($employee->NGAYSINH)->format('d/m/Y') }}</p>
                        </div>
                        <div class="relative">
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-2">Số định danh (CCCD)</p>
                            <p class="text-lg font-bold text-slate-700 tracking-wider">{{ $employee->CCCD }}</p>
                        </div>
                        <div class="relative">
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-2">Giới tính</p>
                            <p class="text-lg font-bold text-slate-700 flex items-center gap-2">
                                <i class="fa-solid {{ $employee->GIOITINH == 'Nam' ? 'fa-mars text-blue-500' : 'fa-venus text-rose-500' }}"></i>
                                {{ $employee->GIOITINH }}
                            </p>
                        </div>
                        <div class="relative">
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-2">Ngày vào làm</p>
                            <p class="text-lg font-bold text-slate-700">{{ \Carbon\Carbon::parse($employee->NGAYVAOLAM)->format('d/m/Y') }}</p>
                        </div>
                        <div class="relative">
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-2">Vị trí công tác</p>
                            <p class="text-lg font-bold text-indigo-600">{{ $employee->CHUCVU }}</p>
                        </div>
                    </div>

                    <div class="mt-12 p-5 bg-slate-50 rounded-2xl flex items-start gap-4 border border-slate-100">
                        <i class="fa-solid fa-circle-info text-slate-400 mt-1"></i>
                        <p class="text-xs text-slate-500 leading-relaxed font-medium">
                            Đây là thông tin nhân sự chính thức của tập đoàn. Mọi thay đổi về dữ liệu cá nhân vui lòng liên hệ phòng Hành chính nhân sự để được cập nhật.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>