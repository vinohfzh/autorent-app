<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('transaksi.pelanggan')->get();
        return view('pembayaran.index', compact('pembayarans'));
    }

    public function create()
    {
        $transaksis = Transaksi::with('pelanggan')
                               ->where('status', 'aktif')
                               ->get();
        return view('pembayaran.create', compact('transaksis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksi,id',
            'jumlah_bayar' => 'required|integer',
            'metode'       => 'required|in:cash,transfer,qris',
            'status_bayar' => 'required|in:lunas,belum_lunas,dp',
            'tgl_bayar'    => 'required|date',
        ]);

        Pembayaran::create($request->all());
        return redirect()->route('pembayaran.index')
                         ->with('success', 'Pembayaran berhasil ditambahkan!');
    }

    public function edit(Pembayaran $pembayaran)
    {
        $transaksis = Transaksi::with('pelanggan')->get();
        return view('pembayaran.edit', compact('pembayaran', 'transaksis'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'jumlah_bayar' => 'required|integer',
            'metode'       => 'required|in:cash,transfer,qris',
            'status_bayar' => 'required|in:lunas,belum_lunas,dp',
            'tgl_bayar'    => 'required|date',
        ]);

        $pembayaran->update($request->all());
        return redirect()->route('pembayaran.index')
                         ->with('success', 'Pembayaran berhasil diupdate!');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route('pembayaran.index')
                         ->with('success', 'Pembayaran berhasil dihapus!');
    }
}