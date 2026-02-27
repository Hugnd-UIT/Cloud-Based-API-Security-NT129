@extends('layouts.master')

@section('title', 'Tổng quan Quản lý - PayShield')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    
    <div class="bg-gradient-to-r from-slate-800 via-blue-900 to-indigo-900 rounded-2xl p-8 text-white shadow-lg relative overflow-hidden flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="relative z-10 w-full">
            <p class="text-blue-200 font-medium mb-1 tracking-wider uppercase text-sm">Trung tâm điều hành nhân sự</p>
            <h2 class="text-3xl font-bold mb-2">Xin chào Quản lý, {{ $manager->HOTEN ?? 'Admin' }}! 🚀</h2>
            <p class="text-blue-100 text-base">Dưới đây là báo cáo tổng quan về tình hình nhân sự và quỹ lương hệ thống.</p>
        </div>
        
        <div class="relative z-10 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl p-4 min-w-[200px] text-center shrink-0 hidden md:block">
            <p class="text-blue-200 text-sm font-medium">Báo cáo ngày</p>
            <p class="text-2xl font-bold">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
            <p class="text-sm text-blue-200 mt-1">{{ \Carbon\Carbon::now()->locale('vi')->translatedFormat('l') }}</p>
        </div>

        <i class="fas fa-chart-pie absolute right-0 bottom-[-20px] text-8xl text-white opacity-5 transform -rotate-12"></i>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 flex flex-col hover:shadow-md transition duration-300">
            <div class="flex items-center gap-4 mb-3">
                <div class="bg-blue-50 text-blue-600 w-12 h-12 rounded-lg flex items-center justify-center text-xl shrink-0 border border-blue-100">
                    <i class="fas fa-users"></i>
                </div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">Nhân sự Active</p>
            </div>
            <h3 class="text-3xl font-bold text-gray-800 mt-auto" id="stat_employees">
                <i class="fas fa-circle-notch fa-spin text-lg text-gray-300"></i>
            </h3>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 flex flex-col hover:shadow-md transition duration-300">
            <div class="flex items-center gap-4 mb-3">
                <div class="bg-emerald-50 text-emerald-600 w-12 h-12 rounded-lg flex items-center justify-center text-xl shrink-0 border border-emerald-100">
                    <i class="fas fa-money-check-alt"></i>
                </div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">Quỹ lương tháng</p>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mt-auto" id="stat_salary">
                <i class="fas fa-circle-notch fa-spin text-lg text-gray-300"></i>
            </h3>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 flex flex-col hover:shadow-md transition duration-300">
            <div class="flex items-center gap-4 mb-3">
                <div class="bg-indigo-50 text-indigo-600 w-12 h-12 rounded-lg flex items-center justify-center text-xl shrink-0 border border-indigo-100">
                    <i class="fas fa-gift"></i>
                </div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">Tổng tiền thưởng</p>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mt-auto" id="stat_bonus">
                <i class="fas fa-circle-notch fa-spin text-lg text-gray-300"></i>
            </h3>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 flex flex-col hover:shadow-md transition duration-300">
            <div class="flex items-center gap-4 mb-3">
                <div class="bg-rose-50 text-rose-600 w-12 h-12 rounded-lg flex items-center justify-center text-xl shrink-0 border border-rose-100">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">Tổng tiền phạt</p>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mt-auto" id="stat_fine">
                <i class="fas fa-circle-notch fa-spin text-lg text-gray-300"></i>
            </h3>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6 border-b border-gray-100 pb-4">
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <div class="bg-blue-100 text-blue-600 w-8 h-8 rounded flex items-center justify-center">
                    <i class="fas fa-chart-line text-sm"></i>
                </div>
                Biến động quỹ lương 6 tháng gần nhất
            </h3>
            <span class="bg-gray-50 text-gray-500 text-xs font-bold px-3 py-1.5 rounded-full border border-gray-200">Tự động cập nhật</span>
        </div>
        
        <div class="relative h-[350px] w-full">
            <canvas id="payrollChart"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const formatVND = (amount) => {
        if (amount === null || amount === undefined) return '0 ₫';
        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
    };

    document.addEventListener('DOMContentLoaded', function() {
        fetch('/api/dashboard/manager-data')
            .then(response => response.json())
            .then(res => {
                if(res.status && res.data) {
                    const stats = res.data.card_stats;
                    const chartData = res.data.chart_stats;

                    document.getElementById('stat_employees').innerText = stats.total_employees + ' NV';
                    document.getElementById('stat_salary').innerText = formatVND(stats.total_salary);
                    document.getElementById('stat_bonus').innerText = formatVND(stats.total_bonus);
                    document.getElementById('stat_fine').innerText = formatVND(stats.total_fine);

                    if(chartData && chartData.length > 0) {
                        renderChart(chartData);
                    } else {
                        document.getElementById('payrollChart').parentElement.innerHTML = `
                            <div class="h-full flex flex-col items-center justify-center text-gray-400">
                                <i class="far fa-chart-bar text-5xl mb-3 opacity-50"></i>
                                <p>Chưa có đủ dữ liệu lương để vẽ biểu đồ</p>
                            </div>
                        `;
                    }
                }
            })
            .catch(err => {
                console.error('Lỗi khi tải dữ liệu Dashboard:', err);
                const errorHtml = '<span class="text-red-500 text-lg">Lỗi tải dữ liệu</span>';
                document.getElementById('stat_employees').innerHTML = errorHtml;
                document.getElementById('stat_salary').innerHTML = errorHtml;
                document.getElementById('stat_bonus').innerHTML = errorHtml;
                document.getElementById('stat_fine').innerHTML = errorHtml;
            });
    });

    function renderChart(data) {
        const ctx = document.getElementById('payrollChart').getContext('2d');
        const labels = data.map(item => item.label);
        const values = data.map(item => item.value);

        new Chart(ctx, {
            type: 'line', 
            data: {
                labels: labels,
                datasets: [{
                    label: 'Tổng quỹ lương thực lĩnh (VNĐ)',
                    data: values,
                    borderColor: '#3b82f6', 
                    backgroundColor: 'rgba(59, 130, 246, 0.08)',
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#3b82f6',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true, 
                    tension: 0.4 
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        titleFont: { family: 'Inter', size: 13 },
                        bodyFont: { family: 'Inter', size: 14, weight: 'bold' },
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) { return formatVND(context.raw); }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [4, 4], color: '#f1f5f9' },
                        ticks: {
                            callback: function(value) {
                                if (value >= 1000000) return (value / 1000000) + ' Tr';
                                return value;
                            },
                            font: { family: 'Inter' },
                            color: '#64748b'
                        },
                        border: { display: false }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Inter' }, color: '#64748b' },
                        border: { display: false }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
            }
        });
    }
</script>
@endpush