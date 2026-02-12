<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chào mừng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .blob { position: absolute; filter: blur(40px); z-index: -1; opacity: 0.4; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 overflow-x-hidden relative">

    <div class="blob bg-blue-300 w-96 h-96 rounded-full top-0 left-0 -translate-x-1/2 -translate-y-1/2"></div>
    <div class="blob bg-purple-300 w-96 h-96 rounded-full bottom-0 right-0 translate-x-1/3 translate-y-1/3"></div>

    <nav class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="bg-blue-600 text-white p-2 rounded-lg text-xl font-bold shadow-lg shadow-blue-500/30">
                <i class="fas fa-shield-alt"></i>
            </div>
            <span class="font-bold text-2xl text-gray-800 tracking-tight">PayShield</span>
        </div>
        <div>
            <a href="/login" class="bg-gray-900 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-gray-800 transition shadow-lg shadow-gray-900/20">
                Đăng nhập
            </a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 pt-10 pb-20 lg:pt-20 lg:pb-32">
        <div class="text-center max-w-3xl mx-auto">
            
            <h1 class="text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
                Quản lý lương & nhân sự <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Bảo mật tuyệt đối</span>
            </h1>
            
            <p class="text-lg text-gray-500 mb-10 leading-relaxed px-4">
                Giải pháp Payroll Cloud-Based an toàn nhất cho doanh nghiệp vừa và nhỏ. 
                Tích hợp bảo mật nhiều lớp, chống tấn công mạng và quản lý dữ liệu tập trung.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="/login" class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white rounded-xl font-bold text-lg hover:bg-blue-700 transition shadow-xl shadow-blue-600/30 flex items-center justify-center gap-2">
                    <i class="fas fa-rocket"></i> Truy cập Hệ thống
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-20">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition group">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition duration-300">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Quản lý Nhân sự</h3>
                <p class="text-gray-500">Lưu trữ hồ sơ nhân viên, chức vụ và phòng ban một cách khoa học và dễ dàng tra cứu.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition group">
                <div class="w-12 h-12 bg-green-50 text-green-600 rounded-lg flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition duration-300">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Tính Lương Tự động</h3>
                <p class="text-gray-500">Hệ thống tự động tính toán lương cứng, thưởng, phạt và xuất báo cáo chi tiết hàng tháng.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition group">
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition duration-300">
                    <i class="fas fa-shield-virus"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Bảo mật Đa lớp</h3>
                <p class="text-gray-500">Được bảo vệ bởi Kong Gateway, Cloudflare Tunnel và xác thực SSO Keycloak.</p>
            </div>
        </div>
    </main>

    <footer class="border-t border-gray-200 py-8 bg-white mt-12">
        <div class="max-w-7xl mx-auto px-6 text-center text-gray-500 text-sm">
            <p>&copy; 2026 PayShield Project</p>
        </div>
    </footer>

</body>
</html>