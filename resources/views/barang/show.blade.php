<x-layouts.index>
    @section('content')
    <h1 class="text-3xl font-semibold mb-6 text-center text-gray-800">Detail Barang</h1>

    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm mx-auto">
        <!-- Product Card -->
        <div>
            <!-- Gambar Barang -->
            @if ($barang->gambar)
                <img class="object-cover h-64 w-full" src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar {{ $barang->nama_barang }}" />
            @else
                <img class="object-cover h-64 w-full" src="https://via.placeholder.com/400x400" alt="No image available" />
            @endif
        </div>

        <div class="flex flex-col gap-1 mt-4 px-4">
            <!-- Nama Barang -->
            <h2 class="text-lg font-semibold text-gray-800">{{ $barang->nama_barang }}</h2>
            <!-- Deskripsi Barang -->
            <span class="font-normal text-gray-600">{{ $barang->deskripsi }}</span>
            <!-- Harga Terjual -->
            <span class="font-semibold text-gray-800">
                {{ 'Rp ' . number_format($barang->harga_beli, 0, ',', '.') }}
            </span>
        </div>

        <div class="flex flex-col gap-1 mt-4 px-4">
            <!-- ID Barang -->
            <div class="flex justify-between items-center">
                <strong class="text-gray-600">ID:</strong>
                <span class="text-gray-800">{{ $barang->id }}</span>
            </div>
            <!-- Harga Beli -->
            <div class="flex justify-between items-center mt-2">
                <strong class="text-gray-600">Terjual:</strong>
                <span class="text-gray-800"> {{ $barang->harga_terjual ? 'Rp ' . number_format($barang->harga_terjual, 0, ',', '.') : 'Belum terjual' }}</span>
            </div>
            <div class="flex justify-between items-center mt-2">
                <strong class="text-gray-600">kontak pembeli:</strong>
                <span class="text-gray-800">{{ $barang->kontak_pembeli }}</span>
            </div>
            <!-- Keuntungan -->
            <div class="flex justify-between items-center mt-2">
                <strong class="text-gray-600">Keuntungan:</strong>
                <span class="text-gray-800">{{ $barang->terjual ? 'Rp ' . number_format($keuntungan, 0, ',', '.') : '-' }}</span>
            </div>
            <!-- Status Terjual -->
            <div class="flex justify-between items-center mt-2">
                <strong class="text-gray-600">Status Terjual:</strong>
                @if ($barang->terjual)
                    <span class="text-green-500 font-semibold">Terjual</span>
                @else
                    <span class="text-red-500 font-semibold">Belum Terjual</span>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-4 p-4 border-t border-gray-200">
        <!-- Button Kembali with Icon -->
        <a href="{{ route('data-barang') }}" class="w-full flex items-center font-bold cursor-pointer hover:underline text-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="text-base">Kembali ke Daftar Barang</span>
        </a>
    </div>
    @endsection
</x-layouts.index>
