<x-layouts.index>
    @section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4 text-center sm:text-left">Laporan Keuangan</h1>

        <!-- Filter -->
        <div x-data="{
                bulan: '{{ request('bulan') ?? date('m') }}',
                tahun: '{{ request('tahun') ?? date('Y') }}',
                exportToExcel() {
                    const table = document.querySelector('table');
                    const ws = XLSX.utils.table_to_sheet(table);
                    const wb = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(wb, ws, 'Laporan Keuangan');
                    XLSX.writeFile(wb, 'laporan-keuangan.xlsx');
                }
            }" class="mb-6 bg-white shadow-md rounded-lg p-4">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('laporan.keuangan') }}" class="flex flex-wrap gap-4 items-center justify-center sm:justify-start">
                <div class="w-full sm:w-auto">
                    <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
                    <select name="bulan" id="bulan" x-model="bulan" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" :selected="bulan == '{{ $i }}'">{{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                        @endfor
                    </select>
                </div>
                <div class="w-full sm:w-auto">
                    <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
                    <input type="number" name="tahun" id="tahun" x-model="tahun" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="mt-4 sm:mt-6">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Laporan -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full border-collapse border border-gray-200 text-sm sm:text-base">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-200 px-4 py-2 text-left font-medium text-gray-700">No.</th>
                        <th class="border border-gray-200 px-4 py-2 text-left font-medium text-gray-700">Nama Barang</th>
                        <th class="border border-gray-200 px-4 py-2 text-left font-medium text-gray-700">Harga Beli</th>
                        <th class="border border-gray-200 px-4 py-2 text-left font-medium text-gray-700">Harga Terjual</th>
                        <th class="border border-gray-200 px-4 py-2 text-left font-medium text-gray-700">Keuntungan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporan as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-200 px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-200 px-4 py-2">{{ $item->nama_barang }}</td>
                            <td class="border border-gray-200 px-4 py-2">Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                            <td class="border border-gray-200 px-4 py-2">Rp {{ number_format($item->harga_terjual, 0, ',', '.') }}</td>
                            <td class="border border-gray-200 px-4 py-2">Rp {{ number_format($item->keuntungan, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Tombol untuk Export -->
            <div class="p-4">
                <button @click="exportToExcel()" class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">
                    Export ke Excel
                </button>
            </div>
        </div>

        <!-- Ringkasan Keuangan -->
        <div class="mt-6 bg-white shadow-md rounded-lg p-4">
            <h4 class="text-lg font-semibold">Ringkasan Keuangan</h4>
            <p><strong>Total Keuntungan:</strong> Rp {{ number_format($totalKeuntungan, 0, ',', '.') }}</p>
            <p><strong>Total Pendapatan:</strong> Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
    </div>
    <script>
     function exportToExcel() {
    try {
        // Menargetkan elemen tabel
        const table = document.querySelector('table');

        if (!table) {
            alert('Tabel tidak ditemukan!');
            return;
        }

        // Mengonversi tabel HTML menjadi sheet Excel
        const ws = XLSX.utils.table_to_sheet(table);
        const wb = XLSX.utils.book_new();

        // Menambahkan sheet ke workbook
        XLSX.utils.book_append_sheet(wb, ws, 'Laporan Keuangan');

        // Menulis file Excel
        XLSX.writeFile(wb, 'laporan-keuangan.xlsx');
    } catch (error) {
        console.error('Gagal melakukan export:', error);
        alert('Terjadi kesalahan saat melakukan export ke Excel.');
    }
}

    </script>
    @endsection
</x-layouts.index>
