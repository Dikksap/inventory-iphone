<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang', 255);
            $table->decimal('harga_barang', 10, 2);
            $table->decimal('harga_beli', 10, 2);
            $table->decimal('harga_jual', 10, 2);
            $table->decimal('harga_terjual', 10, 2)->nullable();
            $table->string('kontak_pembeli', 50)->nullable();
            $table->boolean('terjual')->default(false);
            $table->string('gambar')->nullable();
            $table->unsignedBigInteger('kategori_id'); // Ensure this is unsignedBigInteger

            // Foreign key definition
            $table->foreign('kategori_id')
                  ->references('id')
                  ->on('kategori')
                  ->onDelete('cascade');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
