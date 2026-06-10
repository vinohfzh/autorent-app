<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Kendaraan;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ==============================
        // 1. USERS (Admin + User Biasa)
        // ==============================
        $admin = User::firstOrCreate(
            ['email' => 'admin@autorent.com'],
            [
                'name'     => 'Admin AutoRent',
                'password' => Hash::make('password'),
                'role'     => 'admin',
                'phone'    => '081234567890',
            ]
        );

        $user = User::firstOrCreate(
            ['email' => 'user@autorent.com'],
            [
                'name'     => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role'     => 'user',
                'phone'    => '081298765432',
            ]
        );

        // ==============================
        // 2. KATEGORI KENDARAAN
        // ==============================
        $kategoriData = ['SUV', 'Sedan', 'MPV', 'Hatchback'];
        $kategoris = [];
        foreach ($kategoriData as $nama) {
            $kategoris[$nama] = Kategori::firstOrCreate(
                ['nama_kategori' => $nama],
                ['deskripsi' => 'Kategori kendaraan ' . $nama]
            );
        }

        // ==============================
        // 3. KENDARAAN (5+ data sampel)
        // ==============================
        $kendaraanData = [
            ['nama_mobil' => 'Toyota Avanza',   'merek' => 'Toyota',     'plat_nomor' => 'B 1234 ABC', 'harga_sewa' => 350000,  'status' => 'tersedia',    'kategori' => 'MPV'],
            ['nama_mobil' => 'Honda CR-V',      'merek' => 'Honda',      'plat_nomor' => 'B 5678 DEF', 'harga_sewa' => 550000,  'status' => 'tersedia',    'kategori' => 'SUV'],
            ['nama_mobil' => 'Toyota Camry',    'merek' => 'Toyota',     'plat_nomor' => 'B 9012 GHI', 'harga_sewa' => 650000,  'status' => 'tersedia',    'kategori' => 'Sedan'],
            ['nama_mobil' => 'Mitsubishi Xpander', 'merek' => 'Mitsubishi', 'plat_nomor' => 'B 3456 JKL', 'harga_sewa' => 400000,  'status' => 'tersedia',    'kategori' => 'MPV'],
            ['nama_mobil' => 'Honda Brio',      'merek' => 'Honda',      'plat_nomor' => 'B 7890 MNO', 'harga_sewa' => 250000,  'status' => 'tersedia',    'kategori' => 'Hatchback'],
            ['nama_mobil' => 'Toyota Fortuner', 'merek' => 'Toyota',     'plat_nomor' => 'B 2468 PQR', 'harga_sewa' => 800000,  'status' => 'tersedia',    'kategori' => 'SUV'],
        ];

        $kendaraans = [];
        foreach ($kendaraanData as $data) {
            $kendaraans[] = Kendaraan::firstOrCreate(
                ['plat_nomor' => $data['plat_nomor']],
                [
                    'nama_mobil'  => $data['nama_mobil'],
                    'merek'       => $data['merek'],
                    'harga_sewa'  => $data['harga_sewa'],
                    'status'      => $data['status'],
                    'kategori_id' => $kategoris[$data['kategori']]->id,
                    'keterangan'  => null,
                ]
            );
        }

        // ==============================
        // 4. PELANGGAN (3 data sampel)
        // ==============================
        $pelangganData = [
            ['nama' => 'Andi Pratama',   'no_ktp' => '3201010101010001', 'no_hp' => '081111111111', 'alamat' => 'Jl. Merdeka No. 10, Jakarta Pusat',  'email' => 'andi@email.com'],
            ['nama' => 'Siti Nurhaliza', 'no_ktp' => '3201010101010002', 'no_hp' => '082222222222', 'alamat' => 'Jl. Sudirman No. 25, Jakarta Selatan', 'email' => 'siti@email.com'],
            ['nama' => 'Reza Aditya',    'no_ktp' => '3201010101010003', 'no_hp' => '083333333333', 'alamat' => 'Jl. Gatot Subroto No. 5, Bandung',    'email' => 'reza@email.com'],
        ];

        $pelanggans = [];
        foreach ($pelangganData as $data) {
            $pelanggans[] = Pelanggan::firstOrCreate(
                ['no_ktp' => $data['no_ktp']],
                $data
            );
        }

        // ==============================
        // 5. TRANSAKSI + PEMBAYARAN (data sampel untuk dashboard & chart)
        // ==============================

        // Transaksi 1: Selesai, lunas (bulan lalu)
        $t1 = Transaksi::firstOrCreate(
            ['pelanggan_id' => $pelanggans[0]->id, 'kendaraan_id' => $kendaraans[0]->id, 'tgl_mulai' => now()->subMonth()->startOfMonth()->format('Y-m-d')],
            [
                'tgl_selesai' => now()->subMonth()->startOfMonth()->addDays(3)->format('Y-m-d'),
                'total_hari'  => 3,
                'total_harga' => 3 * 350000,
                'status'      => 'selesai',
            ]
        );
        Pembayaran::firstOrCreate(
            ['transaksi_id' => $t1->id],
            ['jumlah_bayar' => 3 * 350000, 'metode' => 'transfer', 'status_bayar' => 'lunas', 'tgl_bayar' => now()->subMonth()->startOfMonth()->addDay()->format('Y-m-d')]
        );

        // Transaksi 2: Aktif, DP (bulan ini)
        $t2 = Transaksi::firstOrCreate(
            ['pelanggan_id' => $pelanggans[1]->id, 'kendaraan_id' => $kendaraans[1]->id, 'tgl_mulai' => now()->subDays(2)->format('Y-m-d')],
            [
                'tgl_selesai' => now()->addDays(3)->format('Y-m-d'),
                'total_hari'  => 5,
                'total_harga' => 5 * 550000,
                'status'      => 'aktif',
            ]
        );
        Pembayaran::firstOrCreate(
            ['transaksi_id' => $t2->id],
            ['jumlah_bayar' => 1000000, 'metode' => 'qris', 'status_bayar' => 'dp', 'tgl_bayar' => now()->subDays(2)->format('Y-m-d')]
        );

        // Transaksi 3: Selesai, lunas (2 bulan lalu)
        $t3 = Transaksi::firstOrCreate(
            ['pelanggan_id' => $pelanggans[2]->id, 'kendaraan_id' => $kendaraans[2]->id, 'tgl_mulai' => now()->subMonths(2)->startOfMonth()->format('Y-m-d')],
            [
                'tgl_selesai' => now()->subMonths(2)->startOfMonth()->addDays(2)->format('Y-m-d'),
                'total_hari'  => 2,
                'total_harga' => 2 * 650000,
                'status'      => 'selesai',
            ]
        );
        Pembayaran::firstOrCreate(
            ['transaksi_id' => $t3->id],
            ['jumlah_bayar' => 2 * 650000, 'metode' => 'cash', 'status_bayar' => 'lunas', 'tgl_bayar' => now()->subMonths(2)->startOfMonth()->addDay()->format('Y-m-d')]
        );

        // Transaksi 4: Dibatalkan (bulan ini)
        $t4 = Transaksi::firstOrCreate(
            ['pelanggan_id' => $pelanggans[0]->id, 'kendaraan_id' => $kendaraans[3]->id, 'tgl_mulai' => now()->subDays(5)->format('Y-m-d')],
            [
                'tgl_selesai' => now()->subDays(3)->format('Y-m-d'),
                'total_hari'  => 2,
                'total_harga' => 2 * 400000,
                'status'      => 'dibatalkan',
            ]
        );
        Pembayaran::firstOrCreate(
            ['transaksi_id' => $t4->id],
            ['jumlah_bayar' => 400000, 'metode' => 'transfer', 'status_bayar' => 'belum_lunas', 'tgl_bayar' => now()->subDays(5)->format('Y-m-d')]
        );

        // Transaksi 5: Selesai, lunas (3 bulan lalu) — untuk chart data
        $t5 = Transaksi::firstOrCreate(
            ['pelanggan_id' => $pelanggans[1]->id, 'kendaraan_id' => $kendaraans[4]->id, 'tgl_mulai' => now()->subMonths(3)->startOfMonth()->format('Y-m-d')],
            [
                'tgl_selesai' => now()->subMonths(3)->startOfMonth()->addDays(4)->format('Y-m-d'),
                'total_hari'  => 4,
                'total_harga' => 4 * 250000,
                'status'      => 'selesai',
            ]
        );
        Pembayaran::firstOrCreate(
            ['transaksi_id' => $t5->id],
            ['jumlah_bayar' => 4 * 250000, 'metode' => 'qris', 'status_bayar' => 'lunas', 'tgl_bayar' => now()->subMonths(3)->startOfMonth()->addDay()->format('Y-m-d')]
        );

        // Update status mobil yang sedang disewa
        $kendaraans[1]->update(['status' => 'disewa']);
    }
}
