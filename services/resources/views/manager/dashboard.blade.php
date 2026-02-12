<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PayShield</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white border-b border-gray-200 px-6 py-3 flex justify-between items-center shadow-sm sticky top-0 z-50">
        <div class="flex items-center gap-8">
            <div class="flex items-center gap-2">
                <div class="bg-blue-600 text-white p-2 rounded-lg font-bold">PS</div>
                <span class="font-bold text-xl text-gray-700">PayShield</span>
            </div>
            <div class="hidden md:flex gap-6">
                <a href="/dashboard" class="text-blue-600 font-bold border-b-2 border-blue-600 pb-1">Dashboard</a>
                <a href="/roster" class="text-gray-500 hover:text-blue-600 font-medium transition">Nhân sự</a>
                <a href="/payroll" class="text-gray-500 hover:text-blue-600 font-medium transition">Bảng lương</a>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-sm font-bold text-gray-600">AD</div>
            <span class="text-sm font-medium text-gray-600">Admin</span>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <p class="text-gray-500 text-sm font-medium">Nhân sự</p>
                <div class="flex items-end justify-between mt-2">
                    <h3 class="text-3xl font-bold text-gray-800" id="stat_employees">...</h3>
                    <span class="text-blue-600 bg-blue-50 px-2 py-1 rounded text-xs font-semibold">Người</span>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <p class="text-gray-500 text-sm font-medium">Quỹ lương tháng</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-2" id="stat_salary">...</h3>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <p class="text-gray-500 text-sm font-medium">Thưởng</p>
                <h3 class="text-2xl font-bold text-emerald-600 mt-2" id="stat_bonus">...</h3>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <p class="text-gray-500 text-sm font-medium">Phạt</p>
                <h3 class="text-2xl font-bold text-rose-600 mt-2" id="stat_fine">...</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-lg text-gray-700 mb-4">Biểu đồ chi phí lương</h3>
            <div class="relative h-80 w-full">
                <canvas id="salary_chart"></canvas>
            </div>
        </div>
    </div>

    <script>
        const format_money = (amount) => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(amount);
        
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/api/dashboard').then(r => r.json()).then(res => {
                if(res.status) {
                    const stats = res.data.card_stats;
                    document.getElementById('stat_employees').innerText = stats.total_employees;
                    document.getElementById('stat_salary').innerText = format_money(stats.total_salary);
                    document.getElementById('stat_bonus').innerText = format_money(stats.total_bonus);
                    document.getElementById('stat_fine').innerText = format_money(stats.total_fine);
                    
                    new Chart(document.getElementById('salary_chart').getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: res.data.chart_stats.map(i => i.label),
                            datasets: [{
                                label: 'Chi phí ($)',
                                data: res.data.chart_stats.map(i => i.value),
                                borderColor: '#2563eb', backgroundColor: 'rgba(37, 99, 235, 0.1)',
                                borderWidth: 2, fill: true, tension: 0.3
                            }]
                        },
                        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: {display:false} } }
                    });
                }
            });
        });
    </script>
</body>
</html>