<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use App\Models\Kategori;

class BarangSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk mengisi data barang.
     *
     * @return void
     */
    public function run()
    {
        // Cek apakah ada kategori di database
        if (Kategori::count() > 0) {
            // Menambahkan 50 data barang ke database dengan kategori yang valid
            Barang::factory(50)->create();
        } else {
            // Jika tidak ada kategori, tampilkan pesan kesalahan
            echo "Tidak ada kategori yang ditemukan! Pastikan KategoriSeeder telah dijalankan.";
        }
    }
}
