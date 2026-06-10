<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $fillable = [
        'transaksi_id',
        'jumlah_bayar',
        'metode',
        'status_bayar',
        'tgl_bayar'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}