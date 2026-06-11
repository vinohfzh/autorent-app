<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Tampilkan form pembayaran untuk transaksi tertentu.
     */
    public function create($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'kendaraan'])->findOrFail($id);

        return view('checkout-pembayaran', compact('transaksi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaksi_id'     => 'required|exists:transaksis,id',
            'metode'           => 'required|in:bca,mandiri,bri,qris',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $transaksi = Transaksi::findOrFail($request->transaksi_id);

        $path = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        $metode = in_array($request->metode, ['bca', 'mandiri', 'bri']) ? 'transfer' : 'qris';

        Pembayaran::create([
            'transaksi_id'     => $transaksi->id,
            'jumlah_bayar'     => $transaksi->total_harga,
            'metode'           => $metode,
            'status_bayar'     => 'belum_lunas', // Menunggu konfirmasi admin
            'tgl_bayar'        => now(),
            'bukti_pembayaran' => $path,
        ]);

        return redirect()->route('riwayat')
            ->with('success', 'Pembayaran berhasil dikirim! Menunggu konfirmasi admin.');
    }

    public function index()
    {
        $pembayarans = Pembayaran::with('transaksi.pelanggan')->latest()->paginate(10);
        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    public function edit(Pembayaran $pembayaran)
    {
        $transaksis = Transaksi::with('pelanggan')->get();
        return view('pembayaran.edit', compact('pembayaran', 'transaksis'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'jumlah_bayar' => 'required|integer|min:1',
            'metode'       => 'required|in:cash,transfer,qris',
            'status_bayar' => 'required|in:lunas,belum_lunas,dp',
            'tgl_bayar'    => 'required|date',
        ]);

        $pembayaran->update($request->only([
            'jumlah_bayar', 'metode', 'status_bayar', 'tgl_bayar'
        ]));

        return redirect()->route('riwayat')
            ->with('status', 'Data pembayaran berhasil diperbarui!');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route('admin.pembayaran.index')
            ->with('status', 'Pembayaran berhasil dihapus!');
    }
}