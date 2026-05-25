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
    Schema::create('kendaraans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('kategori_id')
              ->constrained('kategoris')
              ->onDelete('cascade');
        $table->string('nama_mobil');
        $table->string('merek');
        $table->string('plat_nomor')->unique();
        $table->integer('harga_sewa');
        $table->enum('status', ['tersedia', 'disewa', 'maintenance'])
              ->default('tersedia');
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};
