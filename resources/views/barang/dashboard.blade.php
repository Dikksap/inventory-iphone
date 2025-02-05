<x-layouts.index>
    @section('content')
    <div x-data="{ isModalOpen: false }" class="min-h-screen bg-gray-50 p-4 sm:p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8 text-center">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Dashboard Barang</h1>
                <p class="text-gray-600 sm:text-lg">Statistik Penjualan {{ now()->format('F Y') }}</p>
            </div>

            <!-- Statistik Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                <!-- Pendapatan Card -->
                <div class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Pendapatan Bulan Ini</h3>
                            <p class="mt-2 text-2xl font-semibold text-green-600">@currency($totalPendapatan)</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Keuntungan Card -->
                <div class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Keuntungan Bulan Ini</h3>
                            <p class="mt-2 text-2xl font-semibold text-blue-600">@currency($totalKeuntungan)</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Barang Terjual Card -->
                <div class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Barang Terjual</h3>
                            <p class="mt-2 text-2xl font-semibold text-purple-600">{{ $barangTerjual }}</p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Section -->
            <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 mb-8">
                <div class="flex flex-col sm:flex-row items-center justify-between mb-4 gap-4">
                    <h2 class="text-lg font-semibold text-gray-800">Grafik Performa Tahunan</h2>
                    <div class="flex gap-2 flex-wrap justify-center">
                        <span class="chart-legend bg-indigo-100 text-indigo-800">
                            <span class="legend-dot bg-indigo-600"></span>
                            Pendapatan
                        </span>
                        <span class="chart-legend bg-pink-100 text-pink-800">
                            <span class="legend-dot bg-pink-600"></span>
                            Keuntungan
                        </span>
                    </div>
                </div>
                <div class="relative" style="height: 300px">
                    <canvas id="chartPenjualanKeuntungan" class="w-full h-full"></canvas>
                </div>
            </div>

            <!-- Modal Trigger Button -->
            <div class="text-center mb-8">
                <button @click="isModalOpen = true"
                        class="btn btn-text btn-success flex items-center justify-center gap-2 mx-auto">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Lihat Detail Transaksi
                </button>
            </div>

            <!-- Modal -->
            <div x-show="isModalOpen" x-cloak
                 class="fixed inset-0 bg-black bg-opacity-30 backdrop-blur-sm transition-opacity z-50"
                 x-transition:enter="ease-out duration-300"
                 x-transition:leave="ease-in duration-200">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div @click.away="isModalOpen = false"
                         class="bg-white rounded-2xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col"
                         x-transition:enter="ease-out duration-300"
                         x-transition:leave="ease-in duration-200">

                        <!-- Modal Header -->
                        <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                            <h3 class="text-xl font-semibold">Detail Transaksi Bulan Ini</h3>
                            <button @click="isModalOpen = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Modal Content -->
                        <div class="overflow-auto flex-1">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50 sticky top-0">
                                    <tr>
                                        <th class="px-4 py-3 text-left font-medium text-gray-500">Nama Barang</th>
                                        <th class="px-4 py-3 text-right font-medium text-gray-500">Harga Jual</th>
                                        <th class="px-4 py-3 text-right font-medium text-gray-500">Keuntungan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($laporanBulanIni as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3">{{ $item->nama_barang }}</td>
                                        <td class="px-4 py-3 text-right">@currency($item->harga_terjual)</td>
                                        <td class="px-4 py-3 text-right font-medium text-green-600">@currency($item->keuntungan)</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                                            Tidak ada transaksi bulan ini
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal Footer -->
                        <div class="p-4 border-t border-gray-200 bg-gray-50">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">
                                    Total {{ $laporanBulanIni->count() }} transaksi
                                </span>
                                <button @click="isModalOpen = false" class="btn-secondary">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart.js Script -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ctx = document.getElementById('chartPenjualanKeuntungan').getContext('2d');
                    const currentMonth = new Date().getMonth();

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: @json($labels),
                            datasets: [
                                {
                                    label: 'Pendapatan',
                                    data: @json($dataPendapatan),
                                    borderColor: '#6366f1',
                                    backgroundColor: '#6366f110',
                                    borderWidth: 2,
                                    tension: 0.4,
                                    fill: true
                                },
                                {
                                    label: 'Keuntungan',
                                    data: @json($dataKeuntungan),
                                    borderColor: '#ec4899',
                                    backgroundColor: '#ec489910',
                                    borderWidth: 2,
                                    tension: 0.4,
                                    fill: true
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                    callbacks: {
                                        label: function(context) {
                                            let label = context.dataset.label || '';
                                            if (label) label += ': ';
                                            if (context.parsed.y !== null) {
                                                label += 'Rp' + context.parsed.y.toLocaleString();
                                            }
                                            return label;
                                        }
                                    }
                                }
                            },
                            interaction: {
                                mode: 'nearest',
                                axis: 'x',
                                intersect: false
                            },
                            scales: {
                                x: {
                                    grid: { display: false },
                                    ticks: {
                                        callback: function(value) {
                                            return ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'][value];
                                        },
                                        maxTicksLimit: 12,
                                        maxRotation: 0,
                                        minRotation: 0
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return 'Rp' + value.toLocaleString();
                                        }
                                    },
                                    grid: {
                                        color: '#e5e7eb',
                                        drawBorder: false
                                    }
                                }
                            }
                        }
                    });
                });
            </script>
        </div>
    </div>

    <style>
        .btn-primary {
            @apply px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 text-sm sm:text-base;
        }

        .btn-secondary {
            @apply px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm;
        }

        .chart-legend {
            @apply px-3 py-1.5 rounded-full text-xs font-medium inline-flex items-center gap-2;
        }

        .legend-dot {
            @apply w-2 h-2 rounded-full;
        }

        [x-cloak] {
            display: none !important;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
    @endsection
</x-layouts.index>
