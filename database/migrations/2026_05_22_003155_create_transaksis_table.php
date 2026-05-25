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
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pelanggan_id')
              ->constrained('pelanggans')
              ->onDelete('cascade');
        $table->foreignId('kendaraan_id')
              ->constrained('kendaraans')
              ->onDelete('cascade');
        $table->date('tgl_mulai');
        $table->date('tgl_selesai');
        $table->integer('total_hari');
        $table->bigInteger('total_harga');
        $table->enum('status', ['aktif', 'selesai', 'dibatalkan'])
              ->default('aktif');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
