<x-layouts.index>
    @section('content')
    <h1 class="text-3xl font-semibold mb-6">Edit Barang</h1>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nama Barang -->
        <div class="mb-4">
            <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang:</label>
            <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" class="w-full p-2 border border-gray-300 rounded-md">
            @error('nama_barang')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
            
        <!-- Harga Barang -->
        <div class="mb-4">
            <label for="harga_barang" class="block text-sm font-medium text-gray-700">Harga Barang:</label>
            <input type="number" name="harga_barang" id="harga_barang" value="{{ old('harga_barang', $barang->harga_barang) }}" class="w-full p-2 border border-gray-300 rounded-md">
            @error('harga_barang')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Harga Beli -->
        <div class="mb-4">
            <label for="harga_beli" class="block text-sm font-medium text-gray-700">Harga Beli:</label>
            <input type="number" name="harga_beli" id="harga_beli" value="{{ old('harga_beli', $barang->harga_beli) }}" class="w-full p-2 border border-gray-300 rounded-md">
            @error('harga_beli')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Harga Jual -->
        <div class="mb-4">
            <label for="harga_jual" class="block text-sm font-medium text-gray-700">Harga Jual:</label>
            <input type="number" name="harga_jual" id="harga_jual" value="{{ old('harga_jual', $barang->harga_jual) }}" class="w-full p-2 border border-gray-300 rounded-md">
            @error('harga_jual')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Harga Terjual -->
        <div class="mb-4">
            <label for="harga_terjual" class="block text-sm font-medium text-gray-700">Harga Terjual:</label>
            <input type="number" name="harga_terjual" id="harga_terjual" value="{{ old('harga_terjual', $barang->harga_terjual) }}" class="w-full p-2 border border-gray-300 rounded-md">
            @error('harga_terjual')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Status Terjual -->
        <div class="mb-4">
            <label for="terjual" class="block text-sm font-medium text-gray-700">Status Terjual:</label>
            <select name="terjual" id="terjual" class="w-full p-2 border border-gray-300 rounded-md">
                <option value="1" {{ old('terjual', $barang->terjual) == 1 ? 'selected' : '' }}>Terjual</option>
                <option value="0" {{ old('terjual', $barang->terjual) == 0 ? 'selected' : '' }}>Belum Terjual</option>
            </select>
            @error('terjual')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Gambar (Opsional) -->
        <div class="mb-4">
            <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar (Opsional):</label>
            <input type="file" name="gambar" id="gambar" class="w-full p-2 border border-gray-300 rounded-md">
            @error('gambar')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan Perubahan</button>
    </form>
    @endsection
</x-layouts.index>
