<x-layouts.index>
    @section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Tambah Barang</h1>

        <!-- Form untuk menambah barang -->
        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" onsubmit="sanitizeHargaBeli()">
            @csrf
            <div class="space-y-6">
                <div class="flex flex-col space-y-4">
                    <div class="flex justify-between space-x-4">
                        <!-- Kategori -->
                        <div class="w-1/3">
                            <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori:</label>
                            <select name="kategori_id" id="kategori_id" required onchange="updateNamaBarang()" class="w-full p-2 border border-gray-300 rounded-md">
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" data-nama="{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Penyimpanan -->
                        <div class="w-1/3">
                            <label for="penyimpanan" class="block text-sm font-medium text-gray-700">Penyimpanan:</label>
                            <select name="penyimpanan" id="penyimpanan" required onchange="updateNamaBarang()" class="w-full p-2 border border-gray-300 rounded-md">
                                <option value="64GB">64GB</option>
                                <option value="128GB">128GB</option>
                                <option value="256GB">256GB</option>
                            </select>
                        </div>

                        <!-- Jenis -->
                        <div class="w-1/3">
                            <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis:</label>
                            <select name="jenis" id="jenis" required onchange="updateNamaBarang()" class="w-full p-2 border border-gray-300 rounded-md">
                                <option value="Ibox">Ibox</option>
                                <option value="Inter">Inter</option>
                                <option value="Beacukai">Beacukai</option>
                            </select>
                        </div>
                    </div>
                </div>


                <!-- Nama Barang -->
                <div>
                    <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang:</label>
                    <input
                        type="text"
                        name="nama_barang"
                        id="nama_barang"
                        value="{{ old('nama_barang') }}"
                        required
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>

                <!-- Harga Beli -->
                <div>
                    <label for="harga_beli" class="block text-sm font-medium text-gray-700">Harga Beli:</label>
                    <input
                        type="text"
                        name="harga_beli"
                        id="harga_beli"
                        value="{{ old('harga_beli') }}"
                        required
                        oninput="formatHargaBeli(event)"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi:</label>
                    <textarea
                        name="deskripsi"
                        id="deskripsi"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                    >{{ old('deskripsi') }}</textarea>
                </div>

                <!-- Gambar -->
                <div x-data="{ preview: null }" class="mt-6">
                    <label for="gambar" class="block text-sm font-medium text-gray-700">Upload Gambar:</label>
                    <div class="flex items-center justify-center w-full mt-2">
                        <label
                            class="flex flex-col items-center w-full h-48 border-2 border-dashed rounded-lg cursor-pointer hover:border-blue-500">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3h9a2.5 2.5 0 012.5 2.5v13a2.5 2.5 0 01-2.5 2.5h-9A2.5 2.5 0 015 18.5v-13A2.5 2.5 0 017.5 3zM12 15.5l4-4m0 0l-4-4m4 4H8"></path></svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500">PNG, JPG up to 10MB</p>
                            </div>
                            <input
                                type="file"
                                id="gambar"
                                name="gambar"
                                class="hidden"
                                @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null"
                            />
                        </label>
                    </div>
                    <div x-show="preview" class="mt-4">
                        <img :src="preview" alt="Preview Gambar" class="w-48 h-48 object-cover rounded-md mx-auto">
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div>
                    <button
                        type="submit"
                        class="w-full py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"
                    >
                        Tambah Barang
                    </button>
                </div>
            </div>
        </form>

        <!-- Menampilkan pesan error -->
        @if ($errors->any())
        <div class="mt-6 bg-red-100 text-red-600 p-4 rounded-lg">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <script>
        function updateNamaBarang() {
            const kategoriSelect = document.getElementById('kategori_id');
            const penyimpananSelect = document.getElementById('penyimpanan');
            const jenisSelect = document.getElementById('jenis');

            const kategori = kategoriSelect.options[kategoriSelect.selectedIndex].getAttribute('data-nama');
            const penyimpanan = penyimpananSelect.value;
            const jenis = jenisSelect.value;

            // Update input nama_barang dengan kombinasi kategori, penyimpanan, dan jenis
            document.getElementById('nama_barang').value = `${kategori} ${penyimpanan} ${jenis}`;
        }

        // Format harga beli dengan titik setiap 3 digit
        function formatHargaBeli(event) {
            let value = event.target.value;
            // Hapus semua karakter yang bukan angka
            value = value.replace(/\D/g, '');
            // Format angka dengan titik setiap 3 digit
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            event.target.value = value;
        }

        // Menghapus titik saat mengirimkan data
        function sanitizeHargaBeli() {
            const hargaBeliInput = document.getElementById('harga_beli');
            hargaBeliInput.value = hargaBeliInput.value.replace(/\./g, ''); // Menghapus titik
        }
    </script>
    @endsection
</x-layouts.index>
