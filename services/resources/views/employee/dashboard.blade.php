<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PayShield</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white shadow-sm px-6 py-4 mb-8">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <div class="font-bold text-xl text-blue-700 flex items-center gap-2">
                <i class="fas fa-shield-alt"></i> PayShield
            </div>
            <a href="/logout" class="text-gray-500 hover:text-red-600 text-sm font-medium">
                <i class="fas fa-sign-out-alt"></i> Đăng xuất
            </a>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-6">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="md:col-span-1 space-y-4">
                <!--Sửa lại link sau khi làm đăng nhập-->
                <a href="/salary" class="block bg-white p-6 rounded-2xl shadow-sm border border-transparent hover:border-blue-500 hover:shadow-md transition group text-center cursor-pointer">
                    <div class="w-16 h-16 mx-auto bg-blue-50 rounded-full flex items-center justify-center text-blue-600 text-2xl mb-4 group-hover:bg-blue-600 group-hover:text-white transition">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg">Tra Cứu Lương</h3>
                    <p class="text-sm text-gray-500 mt-1">Xem chi tiết bảng lương & thưởng</p>
                </a>
                <!--Sửa lại link sau khi làm đăng nhập-->
                <a href="/profile" class="block bg-white p-6 rounded-2xl shadow-sm border border-transparent hover:border-purple-500 hover:shadow-md transition group text-center cursor-pointer">
                    <div class="w-16 h-16 mx-auto bg-purple-50 rounded-full flex items-center justify-center text-purple-600 text-2xl mb-4 group-hover:bg-purple-600 group-hover:text-white transition">
                        <i class="fas fa-user-cog"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg">Hồ sơ cá nhân</h3>
                    <p class="text-sm text-gray-500 mt-1">Cập nhật thông tin tài khoản</p>
                </a>
            </div>

            <div class="md:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm p-6 h-full border border-gray-200">
                    <div class="flex items-center justify-between mb-6 border-b pb-4">
                        <h2 class="text-xl font-bold text-gray-800">
                            <i class="fas fa-bell text-yellow-500 mr-2"></i> Thông báo chung
                        </h2>
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Mới cập nhật</span>
                    </div>

                    <div id="notification_list" class="space-y-4">
                        <p class="text-center text-gray-400 py-10">Đang tải thông báo...</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        fetch('/api/dashboard/employee')
            .then(r => r.json())
            .then(res => {
                if(res.status) {
                    const list = document.getElementById('notification_list');
                    list.innerHTML = ''; 

                    res.data.notifications.forEach(notif => {
                        list.innerHTML += `
                            <div class="p-4 bg-gray-50 rounded-xl hover:bg-blue-50 transition border border-gray-100">
                                <div class="flex justify-between items-start">
                                    <h4 class="font-bold text-gray-800 text-sm">${notif.title}</h4>
                                    <span class="text-xs text-gray-400 whitespace-nowrap">${notif.date}</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-2 leading-relaxed">${notif.content}</p>
                            </div>
                        `;
                    });
                }
            })
            .catch(e => {
                document.getElementById('notification_list').innerHTML = '<p class="text-red-500 text-center">Lỗi tải thông báo</p>';
            });
    </script>
</body>
</html>