<x-layouts.index>
    @section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                <span class="text-blue-600">Daftar</span> Barang
            </h1>
            <a href="{{ route('barang.create') }}"
               class="w-full sm:w-auto flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg transition-colors shadow-sm">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                Tambah Barang
            </a>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border border-gray-100">
            <form action="{{ route('data-barang') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Nama Barang -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Barang</label>
                        <input type="text"
                               name="nama_barang"
                               value="{{ request('nama_barang') }}"
                               placeholder="Masukkan nama barang..."
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent placeholder-gray-400 transition-all">
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent cursor-pointer transition-all">
                            <option value="">Semua Status</option>
                            <option value="terjual" {{ request('status') === 'terjual' ? 'selected' : '' }}>Terjual</option>
                            <option value="belum_terjual" {{ request('status') === 'belum_terjual' ? 'selected' : '' }}>Belum Terjual</option>
                        </select>
                    </div>

                    <!-- Tanggal Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                        <input type="date"
                               name="tanggal"
                               value="{{ request('tanggal') }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all">
                    </div>

                    <!-- Tombol Filter -->
                    <div class="flex items-end">
                        <button type="submit"
                                class="w-full h-[42px] flex items-center justify-center bg-gray-800 hover:bg-gray-900 text-white px-5 py-2.5 rounded-lg transition-colors shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            Filter Data
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">ID</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Nama Barang</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-gray-600">Harga Beli</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Status</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($barangs as $barang)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $barang->id }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $barang->nama_barang }}</td>
                            <td class="px-6 py-4 text-right text-sm text-gray-900 font-medium">
                                @currency($barang->harga_beli)
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    {{ $barang->terjual ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $barang->terjual ? 'Terjual' : 'Belum Terjual' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-4">
                                    <a href="{{ route('barang.show', $barang->id) }}"
                                       class="text-gray-400 hover:text-blue-600 transition-colors"
                                       data-tooltip="Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>

                                    <a href="{{ route('barang.edit', $barang->id) }}"
                                       class="text-gray-400 hover:text-yellow-600 transition-colors"
                                       data-tooltip="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>

                                    <form action="{{ route('barang.destroy', $barang->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')"
                                                class="text-gray-400 hover:text-red-600 transition-colors"
                                                data-tooltip="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $barangs->links() }}
        </div>
    </div>
    @endsection
</x-layouts.index>
