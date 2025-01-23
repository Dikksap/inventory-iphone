<x-layouts.index>
    @section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Tambah Barang</h1>

        <!-- Form untuk menambah barang -->
        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="space-y-6">
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

                <!-- Harga Barang -->
                <div>
                    <label for="harga_barang" class="block text-sm font-medium text-gray-700">Harga Barang:</label>
                    <input
                        type="number"
                        step="0.01"
                        name="harga_barang"
                        id="harga_barang"
                        value="{{ old('harga_barang') }}"
                        required
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>

                <!-- Harga Beli -->
                <div>
                    <label for="harga_beli" class="block text-sm font-medium text-gray-700">Harga Beli:</label>
                    <input
                        type="number"
                        step="0.01"
                        name="harga_beli"
                        id="harga_beli"
                        value="{{ old('harga_beli') }}"
                        required
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>

                <!-- Harga Jual -->
                <div>
                    <label for="harga_jual" class="block text-sm font-medium text-gray-700">Harga Jual:</label>
                    <input
                        type="number"
                        step="0.01"
                        name="harga_jual"
                        id="harga_jual"
                        value="{{ old('harga_jual') }}"
                        required
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>

                <!-- Kategori -->
                <div>
                    <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori:</label>
                    <select name="kategori_id" required>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
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
    @endsection
</x-layouts.index>
