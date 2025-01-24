<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Tentukan kolom yang bisa diisi massal
    protected $fillable = [
        'nama_barang',
        'harga_beli',
        'harga_terjual',
        'kontak_pembeli',
        'terjual',
        'deskripsi', // Tambahkan deskripsi ke fillable
        'gambar',
        'kategori_id', // Tambahkan kategori_id ke fillable
    ];

    /**
     * Mengambil URL gambar (jika ada).
     *
     * @return string
     */
    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : null;
    }

    /**
     * Relasi ke model Kategori.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
