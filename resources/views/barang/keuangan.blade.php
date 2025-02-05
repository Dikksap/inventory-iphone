<x-layouts.index>
    @section('content')
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Header -->
        <div class="mb-8 text-center sm:text-left">
            <h1 class="text-2xl font-bold text-gray-800 sm:text-3xl lg:text-4xl">Laporan Keuangan</h1>
            <p class="mt-2 text-gray-600">Periode: {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}</p>
        </div>

        <!-- Parent Alpine Component -->
        <div x-data="{
                bulan: '{{ $bulan }}',
                tahun: '{{ $tahun }}',
                loading: false,
                async exportToExcel() {
                    try {
                        this.loading = true;
                        const table = this.$refs.reportTable; // Now accessible
                        const ws = XLSX.utils.table_to_sheet(table);
                        const wb = XLSX.utils.book_new();
                        XLSX.utils.book_append_sheet(wb, ws, 'Laporan Keuangan');
                        XLSX.writeFile(wb, `Laporan-Keuangan-${this.bulan}-${this.tahun}.xlsx`);
                    } catch (error) {
                        alert('Error exporting: ' + error.message);
                    } finally {
                        this.loading = false;
                    }
                }
            }">
            <!-- Filter Section -->
            <div class="bg-gray-50 rounded-lg shadow-md p-4 mb-6 border border-gray-200">
                <form method="GET" action="{{ route('laporan.keuangan') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
                    <!-- Bulan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                        <select name="bulan" x-model="bulan" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}" {{ $month == $bulan ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tahun -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <input type="number" name="tahun" x-model="tahun"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               min="2000" max="2100" placeholder="Masukkan tahun">
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center justify-center transition">
                            Filter
                        </button>
                        <button @click.prevent="exportToExcel()" type="button"
                                class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 flex items-center justify-center transition"
                                :disabled="loading">
                            <span x-text="loading ? 'Mengekspor...' : 'Excel'"></span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tabel Laporan -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-sm md:text-base" x-ref="reportTable">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-4 py-3 text-center font-medium text-gray-500 uppercase text-xs md:text-sm lg:text-base border-r">
                                    No
                                </th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase text-xs md:text-sm lg:text-base border-r">
                                    Nama Barang
                                </th>
                                <th class="px-4 py-3 text-right font-medium text-gray-500 uppercase text-xs md:text-sm lg:text-base border-r">
                                    Harga Beli
                                </th>
                                <th class="px-4 py-3 text-right font-medium text-gray-500 uppercase text-xs md:text-sm lg:text-base border-r">
                                    Harga Jual
                                </th>
                                <th class="px-4 py-3 text-right font-medium text-gray-500 uppercase text-xs md:text-sm lg:text-base">
                                    Keuntungan
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($laporan as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-center text-gray-600 text-xs md:text-sm lg:text-base border-r">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-4 py-3 text-gray-900 text-xs md:text-sm lg:text-base border-r">
                                    {{ $item->nama_barang }}
                                </td>
                                <td class="px-4 py-3 text-right text-gray-600 text-xs md:text-sm lg:text-base border-r">
                                    @currency($item->harga_beli)
                                </td>
                                <td class="px-4 py-3 text-right text-gray-600 text-xs md:text-sm lg:text-base border-r">
                                    @currency($item->harga_terjual)
                                </td>
                                <td class="px-4 py-3 text-right text-green-700 font-semibold text-xs md:text-sm lg:text-base">
                                    @currency($item->keuntungan)
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-gray-500 text-xs md:text-sm lg:text-base">
                                    Tidak ada data untuk periode ini
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Ringkasan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold mb-4">Total Keuntungan</h3>
                    <div class="text-2xl font-bold text-green-700">@currency($totalKeuntungan)</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold mb-4">Total Pendapatan</h3>
                    <div class="text-2xl font-bold text-blue-700">@currency($totalPendapatan)</div>
                </div>
            </div>
        </div> <!-- End of Alpine Component -->
    </div>

    <!-- Script untuk XLSX -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    @endsection
</x-layouts.index>
