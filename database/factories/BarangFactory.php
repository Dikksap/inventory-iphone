<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    /**
     * Tentukan nama model yang terkait dengan factory.
     *
     * @var string
     */
    protected $model = Barang::class;

    /**
     * Definisikan data default untuk model barang.
     *
     * @return array
     */
    public function definition()
    {
        // Ambil kategori acak dari database, jika ada
        $kategori = Kategori::inRandomOrder()->first();

        return [
            'nama_barang' => $this->faker->word(),  // Nama barang acak
            'harga_beli' => $this->faker->randomFloat(2, 50000, 800000),  // Harga beli acak
            'harga_terjual' => $this->faker->optional()->randomFloat(2, 80000, 1200000),  // Harga terjual acak (nullable)
            'kontak_pembeli' => $this->faker->optional()->phoneNumber(),  // Kontak pembeli acak (nullable)
            'terjual' => $this->faker->boolean(),  // Status terjual (true/false)
            'gambar' => $this->faker->imageUrl(640, 480, 'business'),  // URL gambar acak
            'kategori_id' => $kategori ? $kategori->id : null,  // Pastikan kategori_id diambil dari kategori yang valid
        ];
    }
}
