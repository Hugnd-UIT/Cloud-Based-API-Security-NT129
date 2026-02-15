<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thu nhập cá nhân | PayShield</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white border-b border-gray-200 px-6 py-4 shadow-sm mb-8">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="bg-emerald-600 text-white p-2 rounded-lg font-bold text-sm">PAY</div>
                <span class="font-bold text-xl tracking-tight text-gray-800">Cổng Tra Cứu Lương</span>
            </div>
            <a href="/profile/{{ $employee->MANV }}" class="text-sm font-bold text-emerald-600 hover:bg-emerald-50 px-4 py-2 rounded-lg transition">
                <i class="fa-solid fa-arrow-left mr-2"></i> Quay lại hồ sơ
            </a>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-6 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-center">
                <p class="text-sm text-gray-400 font-medium">Xin chào,</p>
                <h2 class="text-3xl font-extrabold text-gray-800">{{ $employee->HOTEN }}</h2>
                <div class="flex gap-4 mt-4">
                    <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider">Mã: {{ $employee->MANV }}</span>
                    <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider">{{ $employee->CHUCVU }}</span>
                </div>
            </div>
            
            <div class="bg-emerald-600 p-6 rounded-2xl shadow-lg text-white">
                <p class="text-emerald-100 text-sm font-bold uppercase tracking-widest mb-2">Tổng thu nhập (Năm nay)</p>
                <h3 class="text-3xl font-black">{{ number_format($payrolls->where('NAM', 2026)->sum('TIENLUONGTL')) }}</h3>
                <p class="text-emerald-100 text-xs mt-2 italic">* Bao gồm lương cơ bản, thưởng và phụ cấp</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <h3 class="font-bold text-gray-700 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-chart-line text-emerald-500"></i> Xu hướng thu nhập
                </h3>
                <div class="h-64">
                    <canvas id="salaryChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50">
                    <h3 class="font-bold text-gray-700">Chi tiết các kỳ lương</h3>
                </div>
                <div class="overflow-x-auto max-h-[300px] overflow-y-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr>
                                <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase">Kỳ</th>
                                <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase text-right">Cơ bản</th>
                                <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase text-right">Thưởng/Phạt</th>
                                <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase text-right">Thực lĩnh</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($payrolls as $salary)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm font-bold text-gray-700">{{ $salary->THANG }}/{{ $salary->NAM }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600 text-right">{{ number_format($salary->TIENLUONGCB) }}</td>
                                <td class="px-6 py-4 text-sm text-right">
                                    <span class="text-emerald-600">+{{ number_format($salary->TIENTHUONG) }}</span><br>
                                    <span class="text-rose-500 text-[10px]">-{{ number_format($salary->TIENPHAT) }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm font-black text-emerald-600 text-right">{{ number_format($salary->TIENLUONGTL) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('salaryChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($payrolls->map(fn($p) => "T" . $p->THANG)->toArray()) !!}.reverse(),
                datasets: [{
                    label: 'Thực lĩnh (VNĐ)',
                    data: {!! json_encode($payrolls->map(fn($p) => $p->TIENLUONGTL)->toArray()) !!}.reverse(),
                    borderColor: '#059669',
                    backgroundColor: 'rgba(5, 150, 105, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#059669'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: false, grid: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</body>
</html>