<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Riwayat transaksi milik user yang sedang login.
     * (via relasi pelanggan -> user di masa depan; untuk sekarang tampilkan semua)
     */
    public function index()
    {
        $userEmail = Auth::user()->email;

        $transaksis = Transaksi::with(['pelanggan', 'kendaraan', 'pembayaran'])
            ->whereHas('pelanggan', function ($q) use ($userEmail) {
                $q->where('email', $userEmail);
            })
            ->latest()
            ->paginate(10);

        return view('riwayat', compact('transaksis'));
    }

    /**
     * Tampilkan form checkout untuk kendaraan tertentu.
     */
    public function create($id)
    {
        $kendaraan = Kendaraan::with('kategori')->findOrFail($id);

        if ($kendaraan->status !== 'tersedia') {
            return redirect()->route('katalog')->with('error', 'Kendaraan ini sedang tidak tersedia.');
        }

        return view('checkout', compact('kendaraan'));
    }

    /**
     * Simpan transaksi baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'tgl_mulai'    => 'required|date|after_or_equal:today',
            'tgl_selesai'  => 'required|date|after:tgl_mulai',
            'nama'         => 'required|string|max:255',
            'no_ktp'       => 'required|string|max:20',
            'no_hp'        => 'required|string|max:20',
            'alamat'       => 'required|string',
        ]);

        $kendaraan   = Kendaraan::findOrFail($request->kendaraan_id);
        $tgl_mulai   = \Carbon\Carbon::parse($request->tgl_mulai);
        $tgl_selesai = \Carbon\Carbon::parse($request->tgl_selesai);
        $total_hari  = $tgl_mulai->diffInDays($tgl_selesai);
        $total_harga = $total_hari * $kendaraan->harga_sewa;

        // Buat atau temukan pelanggan berdasarkan nomor KTP
        $pelanggan = \App\Models\Pelanggan::firstOrCreate(
            ['no_ktp' => $request->no_ktp],
            [
                'nama'   => $request->nama,
                'no_hp'  => $request->no_hp,
                'alamat' => $request->alamat,
                'email'  => Auth::user()->email,
            ]
        );

        $transaksi = Transaksi::create([
            'pelanggan_id' => $pelanggan->id,
            'kendaraan_id' => $kendaraan->id,
            'tgl_mulai'    => $request->tgl_mulai,
            'tgl_selesai'  => $request->tgl_selesai,
            'total_hari'   => $total_hari,
            'total_harga'  => $total_harga,
            'status'       => 'aktif',
        ]);

        $kendaraan->update(['status' => 'disewa']);

        return redirect()->route('pembayaran.create', $transaksi->id)
            ->with('status', 'Pemesanan berhasil! Silakan lanjutkan pembayaran.');
    }

    public function edit(Transaksi $transaksi)
    {
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'status' => 'required|in:aktif,selesai,dibatalkan',
        ]);

        if ($request->status === 'selesai' || $request->status === 'dibatalkan') {
            $transaksi->kendaraan->update(['status' => 'tersedia']);
        }

        $transaksi->update(['status' => $request->status]);

        return redirect()->route('riwayat')->with('status', 'Status transaksi berhasil diperbarui!');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->kendaraan->update(['status' => 'tersedia']);
        $transaksi->delete();

        return redirect()->route('riwayat')->with('status', 'Transaksi berhasil dihapus!');
    }

    /**
     * Admin Index Booking
     */
    public function adminIndex(Request $request)
    {
        $query = Transaksi::with(['pelanggan', 'kendaraan', 'pembayaran'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->whereHas('pelanggan', function ($q) use ($searchTerm) {
                $q->where('nama', 'like', "%{$searchTerm}%");
            })->orWhereHas('kendaraan', function ($q) use ($searchTerm) {
                $q->where('nama_mobil', 'like', "%{$searchTerm}%")
                  ->orWhere('plat_nomor', 'like', "%{$searchTerm}%");
            });
        }

        $transaksis = $query->paginate(10)->withQueryString();
        return view('admin.booking.index', compact('transaksis'));
    }

    /**
     * Admin Update Booking Status
     */
    public function adminUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:aktif,selesai,dibatalkan',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        if (($request->status === 'selesai' || $request->status === 'dibatalkan') && $transaksi->kendaraan) {
            $transaksi->kendaraan->update(['status' => 'tersedia']);
        } elseif ($request->status === 'aktif' && $transaksi->kendaraan) {
            $transaksi->kendaraan->update(['status' => 'disewa']);
        }

        $transaksi->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui!');
    }
}