<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Semua seri iPhone
        $iphoneSeries = [
            'iPhone',
            'iPhone 3G',
            'iPhone 3GS',
            'iPhone 4',
            'iPhone 4S',
            'iPhone 5',
            'iPhone 5C',
            'iPhone 5S',
            'iPhone 6',
            'iPhone 6 Plus',
            'iPhone 6S',
            'iPhone 6S Plus',
            'iPhone SE (1st generation)',
            'iPhone 7',
            'iPhone 7 Plus',
            'iPhone 8',
            'iPhone 8 Plus',
            'iPhone X',
            'iPhone XR',
            'iPhone XS',
            'iPhone XS Max',
            'iPhone 11',
            'iPhone 11 Pro',
            'iPhone 11 Pro Max',
            'iPhone SE (2nd generation)',
            'iPhone 12 Mini',
            'iPhone 12',
            'iPhone 12 Pro',
            'iPhone 12 Pro Max',
            'iPhone 13 Mini',
            'iPhone 13',
            'iPhone 13 Pro',
            'iPhone 13 Pro Max',
            'iPhone SE (3rd generation)',
            'iPhone 14',
            'iPhone 14 Plus',
            'iPhone 14 Pro',
            'iPhone 14 Pro Max',
            'iPhone 15',
            'iPhone 15 Plus',
            'iPhone 15 Pro',
            'iPhone 15 Pro Max',
        ];

        foreach ($iphoneSeries as $series) {
            Kategori::create([
                'nama_kategori' => $series
            ]);
        }
    }
}
