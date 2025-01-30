<x-layouts.index>
    @section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-sm p-8">
        <!-- Header -->
        <div class="mb-8 border-b border-gray-200 pb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                <span class="text-blue-600">Edit</span> Barang
                <span class="block mt-1 text-lg font-medium text-gray-500">ID: {{ $barang->id }}</span>
            </h1>
        </div>

        <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data" onsubmit="sanitizeInputValues()">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">
                <!-- Nama Barang -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
                    <div class="relative">
                        <input type="text"
                               name="nama_barang"
                               id="nama_barang"
                               value="{{ old('nama_barang', $barang->nama_barang) }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-400 placeholder-gray-400 transition-all"
                               placeholder="Masukkan nama barang"
                               required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                    </div>
                    @error('nama_barang')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga dan Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Harga Beli -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga Beli</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                            <input type="text"
                                   name="harga_beli"
                                   id="harga_beli"
                                   value="{{ old('harga_beli', number_format($barang->harga_beli, 0, ',', '.')) }}"
                                   oninput="formatNumberInput(event)"
                                   class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-400 placeholder-gray-400 transition-all"
                                   placeholder="0"
                                   required>
                        </div>
                        @error('harga_beli')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Terjual -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Penjualan</label>
                        <div class="relative flex items-center space-x-3">
                            <input type="hidden" name="terjual" value="0">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox"
                                       id="toggle-terjual"
                                       name="terjual"
                                       value="1"
                                       class="sr-only peer"
                                       {{ old('terjual', $barang->terjual) == 1 ? 'checked' : '' }}
                                       onclick="toggleHargaTerjual()">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer-checked:after:translate-x-full peer-checked:bg-blue-600 after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                            <span class="text-sm font-medium text-gray-600">{{ $barang->terjual ? 'Barang Terjual' : 'Belum Terjual' }}</span>
                        </div>
                        @error('terjual')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Conditional Fields -->
                <div id="conditional-fields" class="space-y-6" style="{{ old('terjual', $barang->terjual) == 1 ? '' : 'display: none;' }}">
                    <!-- Harga Terjual -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga Terjual</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                            <input type="text"
                                   name="harga_terjual"
                                   id="harga_terjual"
                                   value="{{ old('harga_terjual', $barang->harga_terjual ? number_format($barang->harga_terjual, 0, ',', '.') : '') }}"
                                   oninput="formatNumberInput(event)"
                                   class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-400 placeholder-gray-400 transition-all"
                                   placeholder="0">
                        </div>
                        @error('harga_terjual')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kontak Pembeli -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kontak Pembeli</label>
                        <div class="relative">
                            <input type="text"
                                   name="kontak_pembeli"
                                   id="kontak_pembeli"
                                   value="{{ old('kontak_pembeli', $barang->kontak_pembeli) }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-400 placeholder-gray-400 transition-all"
                                   placeholder="Contoh: +628123456789">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                        </div>
                        @error('kontak_pembeli')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi"
                              id="deskripsi"
                              rows="4"
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-400 placeholder-gray-400 transition-all"
                              placeholder="Tulis deskripsi barang (opsional)">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gambar -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Barang</label>
                    <div class="flex flex-col sm:flex-row items-start gap-6">
                        @if ($barang->gambar)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $barang->gambar) }}"
                                     alt="Gambar Barang"
                                     class="w-32 h-32 object-cover rounded-lg border-2 border-gray-200">
                            </div>
                        @endif
                        <div class="flex-1 w-full">
                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 transition-colors bg-gray-50/50">
                                <div class="text-center">
                                    <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">
                                        <span class="font-semibold">Klik untuk upload</span> atau drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500">PNG, JPG (Maks. 2MB)</p>
                                </div>
                                <input type="file" name="gambar" id="gambar" class="hidden">
                            </label>
                        </div>
                    </div>
                    @error('gambar')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-8">
                    <button type="submit"
                            class="w-full sm:w-auto px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Toggle conditional fields
        function toggleHargaTerjual() {
            const container = document.getElementById('conditional-fields');
            container.style.display = document.getElementById('toggle-terjual').checked ? 'block' : 'none';
        }

        // Number formatting
        function formatNumberInput(event) {
            let value = event.target.value.replace(/\./g, '');
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            event.target.value = value;
        }

        // Sanitize input before submit
        function sanitizeInputValues() {
            ['harga_beli', 'harga_terjual'].forEach(id => {
                const input = document.getElementById(id);
                if (input) input.value = input.value.replace(/\./g, '');
            });
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', () => {
            toggleHargaTerjual();
        });
    </script>
    @endsection
</x-layouts.index>
