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
    Schema::create('pembayarans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('transaksi_id')
              ->constrained('transaksis')
              ->onDelete('cascade');
        $table->bigInteger('jumlah_bayar');
        $table->enum('metode', ['cash', 'transfer', 'qris'])
              ->default('cash');
        $table->enum('status_bayar', ['lunas', 'belum_lunas', 'dp'])
              ->default('belum_lunas');
        $table->date('tgl_bayar');
        $table->timestamps();
    });
}    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
