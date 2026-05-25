<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['pelanggan', 'kendaraan'])->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $kendaraans = Kendaraan::where('status', 'tersedia')->get();
        return view('transaksi.create', compact('pelanggans', 'kendaraans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'tgl_mulai'    => 'required|date',
            'tgl_selesai'  => 'required|date|after:tgl_mulai',
        ]);

        $kendaraan   = Kendaraan::findOrFail($request->kendaraan_id);
        $tgl_mulai   = \Carbon\Carbon::parse($request->tgl_mulai);
        $tgl_selesai = \Carbon\Carbon::parse($request->tgl_selesai);
        $total_hari  = $tgl_mulai->diffInDays($tgl_selesai);
        $total_harga = $total_hari * $kendaraan->harga_sewa;

        Transaksi::create([
            'pelanggan_id' => $request->pelanggan_id,
            'kendaraan_id' => $request->kendaraan_id,
            'tgl_mulai'    => $request->tgl_mulai,
            'tgl_selesai'  => $request->tgl_selesai,
            'total_hari'   => $total_hari,
            'total_harga'  => $total_harga,
            'status'       => 'aktif',
        ]);

        $kendaraan->update(['status' => 'disewa']);

        return redirect()->route('transaksi.index')
                         ->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit(Transaksi $transaksi)
    {
        $pelanggans = Pelanggan::all();
        $kendaraans = Kendaraan::all();
        return view('transaksi.edit', compact('transaksi', 'pelanggans', 'kendaraans'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'status' => 'required|in:aktif,selesai,dibatalkan',
        ]);

        // Jika status selesai, ubah kendaraan jadi tersedia
        if ($request->status === 'selesai' || $request->status === 'dibatalkan') {
            $transaksi->kendaraan->update(['status' => 'tersedia']);
        }

        $transaksi->update(['status' => $request->status]);
        return redirect()->route('transaksi.index')
                         ->with('success', 'Transaksi berhasil diupdate!');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->kendaraan->update(['status' => 'tersedia']);
        $transaksi->delete();
        return redirect()->route('transaksi.index')
                         ->with('success', 'Transaksi berhasil dihapus!');
    }
}