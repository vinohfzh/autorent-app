<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'pelanggan_id',
        'kendaraan_id',
        'tgl_mulai',
        'tgl_selesai',
        'total_hari',
        'total_harga',
        'status'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}