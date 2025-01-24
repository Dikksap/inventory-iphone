<x-layouts.index>
    @section('content')
    <div x-data="{ isModalOpen: false }" class="min-h-screen bg-gray-100 p-6">
        <div class="container mx-auto">
            <!-- Header -->
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Dashboard Barang</h1>

            <!-- Statistik Bulanan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Pendapatan Bulan Ini -->
                <div class="p-6 bg-white shadow-lg rounded-lg hover:shadow-xl transition duration-300">
                    <h2 class="text-lg font-semibold text-gray-600">Pendapatan Bulan Ini</h2>
                    <p class="text-2xl font-bold text-green-500 mt-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
                <!-- Keuntungan Bulan Ini -->
                <div class="p-6 bg-white shadow-lg rounded-lg hover:shadow-xl transition duration-300">
                    <h2 class="text-lg font-semibold text-gray-600">Keuntungan Bulan Ini</h2>
                    <p class="text-2xl font-bold text-blue-500 mt-2">Rp {{ number_format($totalKeuntungan, 0, ',', '.') }}</p>
                </div>
                <!-- Barang Terjual Bulan Ini -->
                <div class="p-6 bg-white shadow-lg rounded-lg hover:shadow-xl transition duration-300">
                    <h2 class="text-lg font-semibold text-gray-600">Barang Terjual Bulan Ini</h2>
                    <p class="text-2xl font-bold text-purple-500 mt-2">{{ $barangTerjual }}</p>
                </div>
            </div>

            <!-- Grafik Penjualan dan Keuntungan -->
            <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Grafik Penjualan dan Keuntungan</h2>
                <div class="relative" style="height: 300px;">
                    <canvas id="chartPenjualanKeuntungan"></canvas>
                </div>
            </div>

            <!-- Modal untuk Laporan Bulan Ini -->
            <button @click="isModalOpen = true" class="px-4 py-2 bg-blue-500 text-white rounded-lg">
                Detail Bulan Ini
            </button>

            <!-- Modal Detail -->
            <div x-show="isModalOpen" @click.away="isModalOpen = false" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
                <div class="bg-white rounded-lg shadow-lg p-6 w-full sm:w-3/4 md:w-2/3 lg:w-1/2">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Detail Bulan Ini</h3>
                    <table class="w-full text-left table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr>
                                <th class="border border-gray-200 px-4 py-2">Nama Barang</th>
                                <th class="border border-gray-200 px-4 py-2">Harga Terjual</th>
                                <th class="border border-gray-200 px-4 py-2">Keuntungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporanBulanIni as $item)
                                <tr>
                                    <td class="border border-gray-200 px-4 py-2">{{ $item->nama_barang }}</td>
                                    <td class="border border-gray-200 px-4 py-2">Rp {{ number_format($item->harga_terjual, 0, ',', '.') }}</td>
                                    <td class="border border-gray-200 px-4 py-2">Rp {{ number_format($item->keuntungan, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button @click="isModalOpen = false" class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg">
                        Tutup
                    </button>
                </div>
            </div>

            <!-- Chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctx = document.getElementById('chartPenjualanKeuntungan').getContext('2d');
                const chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($labels),  // Bulan (1-12)
                        datasets: [
                            {
                                label: 'Pendapatan',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                data: @json($dataPendapatan),  // Data pendapatan per bulan
                                fill: true,
                            },
                            {
                                label: 'Keuntungan',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                data: @json($dataKeuntungan),  // Data keuntungan per bulan
                                fill: true,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                ticks: {
                                    callback: function(value) {
                                        const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                                        return months[value];  // Display month names instead of numbers
                                    }
                                }
                            },
                            y: {
                                beginAtZero: true,
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
    @endsection
</x-layouts.index>
