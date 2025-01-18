<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori'; // Nama tabel

    protected $fillable = [
        'nama_kategori', // Kolom yang bisa diisi
    ];

    /**
     * Relasi ke model Barang.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kategori_id'); // Relasi barang ke kategori
    }
}
