<x-layouts.index>
    @section('content')
    <h1 class="text-3xl font-semibold mb-6 text-center text-gray-800">Detail Barang</h1>

    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h2 class="text-2xl font-semibold text-gray-800">{{ $barang->nama_barang }}</h2>

        <div class="mt-4">
            <strong class="text-gray-600">ID:</strong> <span class="text-gray-800">{{ $barang->id }}</span>
        </div>
        <div class="mt-2">
            <strong class="text-gray-600">Harga Beli:</strong> <span class="text-gray-800">{{ number_format($barang->harga_beli, 2) }}</span>
        </div>
        <div class="mt-2">
            <strong class="text-gray-600">Harga Jual:</strong> <span class="text-gray-800">{{ number_format($barang->harga_jual, 2) }}</span>
        </div>
        <div class="mt-2">
            <strong class="text-gray-600">Harga Terjual:</strong> <span class="text-gray-800">{{ number_format($barang->harga_terjual, 2) }}</span>
        </div>
        <div class="mt-2">
            <strong class="text-gray-600">Keuntungan:</strong> <span class="text-gray-800">{{ number_format($keuntungan, 2) }}</span>
        </div>
        <div class="mt-2">
            <strong class="text-gray-600">Status Terjual:</strong>
            @if ($barang->terjual)
                <span class="text-green-500 font-semibold">Terjual</span>
            @else
                <span class="text-red-500 font-semibold">Belum Terjual</span>
            @endif
        </div>

        @if ($barang->gambar)
            <div class="mt-4">
                <strong class="text-gray-600">Gambar Barang:</strong><br>
                <img src="{{ $barang->gambar_url }}" alt="Gambar {{ $barang->nama_barang }}" class="w-64 h-64 object-cover rounded-md shadow-md mx-auto mt-2">
            </div>
        @else
            <div class="mt-4">
                <strong class="text-gray-600">Gambar:</strong> Tidak ada gambar.
            </div>
        @endif

        <div class="mt-6 text-center">
            <a href="{{ route('data-barang') }}" class="px-6 py-3 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700 transition duration-200">Kembali ke Daftar Barang</a>
        </div>
    </div>
    @endsection
</x-layouts.index>
