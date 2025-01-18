<!-- resources/views/barang/index.blade.php -->

<x-layouts.index>
    @section('content')
    <h1 class="text-3xl font-semibold mb-6">Daftar Barang</h1>

    <!-- Form Filter -->
    <form action="{{ route('data-barang') }}" method="GET" class="mb-6">
        <div class="flex flex-col sm:flex-row space-x-0 sm:space-x-4 space-y-4 sm:space-y-0">
            <!-- Filter Nama Barang -->
            <div class="flex-1">
                <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang:</label>
                <input type="text" name="nama_barang" id="nama_barang" value="{{ request('nama_barang') }}" class="w-full sm:w-64 p-2 border border-gray-300 rounded-md">
            </div>

            <!-- Filter Status -->
            <div class="flex-1">
                <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                <select name="status" id="status" class="w-full sm:w-32 p-2 border border-gray-300 rounded-md">
                    <option value="">Pilih Status</option>
                    <option value="terjual" {{ request('status') === 'terjual' ? 'selected' : '' }}>Terjual</option>
                    <option value="belum_terjual" {{ request('status') === 'belum_terjual' ? 'selected' : '' }}>Belum Terjual</option>
                </select>
            </div>

            <!-- Tombol Filter -->
            <div class="flex items-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Filter</button>
            </div>
        </div>
    </form>

    <!-- Tabel Daftar Barang -->
    <div class="bg-white overflow-auto">
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr>
                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">ID</th>
                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Nama Barang</th>
                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Harga Beli</th>
                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Status Terjual</th>
                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $barang)
                    <tr class="hover:bg-grey-lighter">
                        <td class="py-4 px-6 border-b border-grey-light">{{ $barang->id }}</td>
                        <td class="py-4 px-6 border-b border-grey-light">{{ $barang->nama_barang }}</td>
                        <td class="py-4 px-6 border-b border-grey-light">{{ number_format($barang->harga_beli, 2) }}</td>
                        <td class="py-4 px-6 border-b border-grey-light">
                            <span class="px-2 py-1 text-white rounded-full
                                {{ $barang->terjual ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ $barang->terjual ? 'Terjual' : 'Belum Terjual' }}
                            </span>
                        </td>
                        <td class="py-4 px-6 border-b border-grey-light">
                            <a href="{{ route('barang.show', $barang->id) }}" class="text-blue-600 hover:underline">Detail</a>
                        </td>
                        <td class="py-4 px-6 border-b border-grey-light">
                            <a href="{{ route('barang.edit', $barang->id) }}" class="text-yellow-500 hover:underline mr-2">Edit</a>
                            <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    {{ $barangs->links() }}
    @endsection
</x-layouts.index>
