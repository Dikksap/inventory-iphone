<x-layouts.index>
    @section('content')
    <h1 class="text-3xl font-semibold mb-6">Edit Barang</h1>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data" onsubmit="sanitizeInputValues()">
        @csrf
        @method('PUT')

        <!-- Nama Barang -->
        <div class="mb-4">
            <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang:</label>
            <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" class="w-full p-2 border border-gray-300 rounded-md" required>
            @error('nama_barang')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Harga Beli -->
        <div class="mb-4">
            <label for="harga_beli" class="block text-sm font-medium text-gray-700">Harga Beli:</label>
            <input type="text" name="harga_beli" id="harga_beli" value="{{ old('harga_beli', number_format($barang->harga_beli, 0, ',', '.')) }}" oninput="formatNumberInput(event)" class="w-full p-2 border border-gray-300 rounded-md" required>
            @error('harga_beli')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Status Terjual:</label>
            <!-- Hidden input untuk nilai default -->
            <input type="hidden" name="terjual" value="0">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" id="toggle-terjual" name="terjual" value="1" class="sr-only peer" {{ old('terjual', $barang->terjual) == 1 ? 'checked' : '' }} onclick="toggleHargaTerjual()">
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Terjual</span>
            </label>
            @error('terjual')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Harga Terjual -->
        <div class="mb-4" id="harga-terjual-container" style="{{ old('terjual', $barang->terjual) == 1 ? '' : 'display: none;' }}">
            <label for="harga_terjual" class="block text-sm font-medium text-gray-700">Harga Terjual:</label>
            <input type="text" name="harga_terjual" id="harga_terjual" value="{{ old('harga_terjual', number_format($barang->harga_terjual, 0, ',', '.')) }}" oninput="formatNumberInput(event)" class="w-full p-2 border border-gray-300 rounded-md">
            @error('harga_terjual')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Kontak Pembeli -->
        <div class="mb-4" id="kontak-pembeli-container" style="{{ old('terjual', $barang->terjual) == 1 ? '' : 'display: none;' }}">
            <label for="kontak_pembeli" class="block text-sm font-medium text-gray-700">Kontak Pembeli:</label>
            <input type="text" name="kontak_pembeli" id="kontak_pembeli" value="{{ old('kontak_pembeli', $barang->kontak_pembeli) }}" class="w-full p-2 border border-gray-300 rounded-md">
            @error('kontak_pembeli')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional):</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full p-2 border border-gray-300 rounded-md">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Gambar (Opsional) -->
        <div class="mb-4">
            <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar (Opsional):</label>
            <div class="flex items-center gap-4">
                @if ($barang->gambar)
                    <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Barang" class="w-16 h-16 object-cover rounded-md">
                @endif
                <input type="file" name="gambar" id="gambar" class="w-full p-2 border border-gray-300 rounded-md">
            </div>
            @error('gambar')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan Perubahan</button>
    </form>

    <script>
        // Toggle untuk menampilkan/menghilangkan input harga terjual dan kontak pembeli
        function toggleHargaTerjual() {
            const toggle = document.getElementById('toggle-terjual');
            const hargaTerjualContainer = document.getElementById('harga-terjual-container');
            const kontakPembeliContainer = document.getElementById('kontak-pembeli-container');
            const isChecked = toggle.checked;

            hargaTerjualContainer.style.display = isChecked ? 'block' : 'none';
            kontakPembeliContainer.style.display = isChecked ? 'block' : 'none';
        }

        // Format input angka dengan titik setiap 3 digit
        function formatNumberInput(event) {
            let value = event.target.value.replace(/\D/g, ''); // Hanya angka
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Tambahkan titik
            event.target.value = value;
        }

        // Hapus format titik sebelum submit form
        function sanitizeInputValues() {
            const inputs = ['harga_beli', 'harga_terjual'];
            inputs.forEach(id => {
                const input = document.getElementById(id);
                if (input) {
                    input.value = input.value.replace(/\./g, ''); // Hapus semua titik
                }
            });
        }

        // Inisialisasi tampilan awal toggle
        document.addEventListener('DOMContentLoaded', () => {
            toggleHargaTerjual();
        });
    </script>
    @endsection
</x-layouts.index>
