<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Dashboard - Quản Lý Lương</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white border-b border-gray-200 px-6 py-3 flex justify-between items-center shadow-sm">
        <div class="flex items-center gap-3">
            <div class="bg-blue-600 text-white p-2 rounded-lg font-bold">HR</div>
            <span class="font-bold text-xl text-gray-700">Dashboard Quản Lý</span>
        </div>
        <div class="text-sm text-gray-500">Xin chào, Admin</div>
    </nav>

    <div class="max-w-7xl mx-auto p-6">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm font-medium">Nhân sự đang làm việc</p>
                <div class="flex items-end justify-between mt-2">
                    <h3 class="text-3xl font-bold text-gray-800" id="stat-nhanvien">...</h3>
                    <span class="text-blue-500 bg-blue-50 px-2 py-1 rounded text-xs">Người</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm font-medium">Tổng quỹ lương tháng này</p>
                <div class="mt-2">
                    <h3 class="text-2xl font-bold text-gray-800" id="stat-luong">...</h3>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm font-medium">Tổng tiền thưởng</p>
                <div class="mt-2">
                    <h3 class="text-2xl font-bold text-emerald-600" id="stat-thuong">...</h3>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm font-medium">Tổng tiền phạt</p>
                <div class="mt-2">
                    <h3 class="text-2xl font-bold text-rose-600" id="stat-phat">...</h3>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-lg text-gray-700 mb-4">Biểu đồ chi phí lương 6 tháng gần nhất</h3>
            <div class="relative h-80 w-full">
                <canvas id="salaryChart"></canvas>
            </div>
        </div>

    </div>

    <script>
        const formatMoney = (amount) => {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
        };

        document.addEventListener('DOMContentLoaded', function() {
            fetch('/api/dashboard')
                .then(response => response.json())
                .then(res => {
                if(res.status) {
                    const stats = res.data.card_stats;
                    const chart = res.data.chart_stats;

                    document.getElementById('stat-nhanvien').innerText = stats.tong_nhan_vien;
                    document.getElementById('stat-luong').innerText = formatMoney(stats.tong_luong);
                    document.getElementById('stat-thuong').innerText = formatMoney(stats.tong_thuong);
                    document.getElementById('stat-phat').innerText = formatMoney(stats.tong_phat);

                    const ctx = document.getElementById('salaryChart').getContext('2d');
                    const labels = chart.map(item => item.label); 
                    const values = chart.map(item => item.value); 
                    new Chart(ctx, {
                        type: 'line', 
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Tổng chi lương (VNĐ)',
                                data: values,
                                borderColor: '#2563eb',
                                backgroundColor: 'rgba(37, 99, 235, 0.1)', 
                                borderWidth: 2,
                                tension: 0.3, 
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return new Intl.NumberFormat('vi-VN', { notation: "compact" }).format(value) + ' đ';
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            })
            .catch(err => console.error("Lỗi tải dữ liệu:", err));
        });
    </script>
</body>
</html>