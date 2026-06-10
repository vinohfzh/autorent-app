<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Dashboard Overview
     */
    public function dashboard()
    {
        // Stats
        $totalBooking = Transaksi::count();
        $totalRevenue = Pembayaran::sum('jumlah_bayar');
        $activeCars = Kendaraan::where('status', 'disewa')->count();
        $totalUsers = User::where('role', 'user')->count();

        // Butuh Konfirmasi: Pembayaran with status_bayar 'belum_lunas' or 'dp'
        $butuhKonfirmasi = Pembayaran::with(['transaksi.pelanggan', 'transaksi.kendaraan'])
            ->whereIn('status_bayar', ['belum_lunas', 'dp'])
            ->latest()
            ->take(5)
            ->get();

        // Booking Terbaru
        $bookingTerbaru = Transaksi::with(['pelanggan', 'kendaraan', 'pembayaran'])
            ->latest()
            ->take(5)
            ->get();

        // Chart 1: Pendapatan Bulanan (Last 6 Months)
        $sixMonthsAgo = now()->subMonths(5)->startOfMonth();
        $pembayarans = Pembayaran::where('tgl_bayar', '>=', $sixMonthsAgo)->get();

        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('M');
            $monthlyData[$month] = 0;
        }

        foreach ($pembayarans as $p) {
            $month = \Carbon\Carbon::parse($p->tgl_bayar)->format('M');
            if (isset($monthlyData[$month])) {
                $monthlyData[$month] += $p->jumlah_bayar;
            }
        }

        $chartMonths = array_keys($monthlyData);
        $chartTotals = array_values($monthlyData);

        // Chart 2: Kategori Armada (Distribution)
        $kategoriData = Kendaraan::select('kategori_id', DB::raw('count(*) as count'))
            ->groupBy('kategori_id')
            ->with('kategori')
            ->get();

        $kategoriLabels = [];
        $kategoriCounts = [];
        foreach ($kategoriData as $kd) {
            $kategoriLabels[] = $kd->kategori ? $kd->kategori->nama_kategori : 'Lainnya';
            $kategoriCounts[] = $kd->count;
        }

        if (empty($kategoriLabels)) {
            $kategoriLabels = ['SUV', 'Sedan', 'MPV'];
            $kategoriCounts = [0, 0, 0];
        }

        return view('admin.dashboard', compact(
            'totalBooking',
            'totalRevenue',
            'activeCars',
            'totalUsers',
            'butuhKonfirmasi',
            'bookingTerbaru',
            'chartMonths',
            'chartTotals',
            'kategoriLabels',
            'kategoriCounts'
        ));
    }

    /**
     * Approve Payment
     */
    public function approvePayment($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update(['status_bayar' => 'lunas']);

        // Set transaksi status to active
        if ($pembayaran->transaksi) {
            $pembayaran->transaksi->update(['status' => 'aktif']);
        }

        return redirect()->back()->with('success', 'Pembayaran berhasil disetujui (Lunas)!');
    }

    /**
     * Reject Payment / Cancel Booking
     */
    public function rejectPayment($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update(['status_bayar' => 'belum_lunas']);

        if ($pembayaran->transaksi) {
            $pembayaran->transaksi->update(['status' => 'dibatalkan']);
            if ($pembayaran->transaksi->kendaraan) {
                $pembayaran->transaksi->kendaraan->update(['status' => 'tersedia']);
            }
        }

        return redirect()->back()->with('success', 'Pesanan/pembayaran berhasil ditolak!');
    }
}
