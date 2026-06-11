# 🚗 AutoRent — Aplikasi Sewa Mobil Berbasis Web


---

## 👤 Identitas Pembuat

| Keterangan | Detail |
|---|---|
| **Nama** | Vino Hafizh Khairuddin |
| **Kelas** | XI RPL |
| **No. Absen** | 41 |

---

## 📌 Deskripsi Proyek

**AutoRent** adalah sebuah aplikasi manajemen sewa mobil berbasis web yang dibangun menggunakan framework **Laravel**. Proyek ini dibuat sebagai tugas praktik pemrograman web untuk memenuhi kompetensi pengembangan aplikasi berbasis web pada jurusan **Rekayasa Perangkat Lunak (RPL)**.

Aplikasi ini dirancang untuk mempermudah proses penyewaan kendaraan, baik dari sisi penyewa (pelanggan) maupun dari sisi pengelola (admin). Dengan tampilan yang modern dan responsif, AutoRent memberikan pengalaman yang nyaman dalam melakukan pemesanan hingga pembayaran kendaraan secara online.

---

## 🎯 Tujuan Proyek

- Membangun sistem informasi sewa kendaraan yang terstruktur dan efisien.
- Menerapkan konsep **CRUD (Create, Read, Update, Delete)** dalam pengelolaan data.
- Mengimplementasikan sistem **autentikasi dan otorisasi** berbasis role (Admin & User).
- Membuat antarmuka pengguna (UI) yang **modern, responsif, dan mudah digunakan**.

---

## ✨ Fitur Unggulan

### 👥 Fitur Pengguna (Penyewa)
| Fitur | Keterangan |
|---|---|
| 🔐 Autentikasi | Registrasi akun baru, login, dan manajemen profil pengguna |
| 🚙 Katalog Kendaraan | Menampilkan seluruh daftar mobil yang tersedia beserta detail lengkap (merk, kategori, harga sewa per hari, dan foto) |
| 📋 Form Pemesanan | Isi data diri dan pilih tanggal sewa; total biaya dihitung otomatis |
| 💳 Pembayaran Online | Mendukung berbagai metode bayar: Transfer Bank, E-Wallet, dan Cash; dilengkapi upload bukti pembayaran |
| 🗂️ Riwayat Sewa | Melihat seluruh transaksi dengan filter status (Aktif, Selesai, Dibatalkan) dan detail lengkap tiap pemesanan |

### 🛡️ Fitur Admin (Dashboard)
| Fitur | Keterangan |
|---|---|
| 📊 Dashboard Statistik | Ringkasan jumlah kendaraan, pelanggan baru, transaksi aktif, dan aktivitas terbaru |
| 🚗 Manajemen Kendaraan | Tambah, ubah, dan hapus data kendaraan di katalog (termasuk upload foto) |
| 👤 Manajemen Pelanggan | Menampilkan daftar pelanggan beserta nomor urut, kontak, dan informasi identitas |
| 📑 Kelola Booking | Memantau seluruh transaksi sewa dan memperbarui status pemesanan (Aktif → Selesai / Dibatalkan) |
| 💰 Kelola Pembayaran | Verifikasi pembayaran pelanggan, konfirmasi bukti transfer, dan perbarui status lunas |

---

## 🛠️ Teknologi yang Digunakan

| Komponen | Teknologi |
|---|---|
| **Backend Framework** | Laravel 11 (PHP) |
| **Frontend** | Blade Templating Engine, Bootstrap 5, Vanilla CSS |
| **Database** | MySQL |
| **Autentikasi** | Laravel Breeze |
| **Ikon** | Bootstrap Icons |
| **Penyimpanan File** | Laravel Storage (local disk) |

---

## 🚀 Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi ini di komputer Anda:

### Prasyarat
- PHP >= 8.2
- Composer
- MySQL
- Node.js & NPM

### Langkah-langkah

**1. Clone repository ini:**
```bash
git clone https://github.com/vinohfzh/autorent-app.git
cd autorent-app
```

**2. Install dependency PHP:**
```bash
composer install
```

**3. Install dependency NPM:**
```bash
npm install && npm run build
```

**4. Konfigurasi Environment:**
```bash
cp .env.example .env
```
Buka file `.env`, lalu sesuaikan pengaturan database:
```env
DB_DATABASE=autorent
DB_USERNAME=root
DB_PASSWORD=
```

**5. Generate App Key:**
```bash
php artisan key:generate
```

**6. Buat database dan jalankan migrasi:**
```bash
php artisan migrate --seed
```

**7. Link folder storage (untuk akses foto kendaraan):**
```bash
php artisan storage:link
```

**8. Jalankan server lokal:**
```bash
php artisan serve
```

Aplikasi dapat diakses melalui **http://localhost:8000**

---

## 🔑 Akun Default (Setelah Seeder)

| Role | Email | Password |
|---|---|---|
| Admin | admin@autorent.com | password |
| User | user@autorent.com | password |

---

## 📁 Struktur Direktori Penting

```
autorent-app/
├── app/
│   ├── Http/Controllers/   # Logic controller (Admin & User)
│   └── Models/             # Model Eloquent (Kendaraan, Transaksi, Pelanggan, dll)
├── database/
│   ├── migrations/         # Skema tabel database
│   └── seeders/            # Data awal (dummy data)
├── resources/
│   └── views/              # Template tampilan (Blade)
│       ├── admin/          # Halaman dashboard admin
│       └── ...             # Halaman untuk pengguna
└── routes/
    └── web.php             # Definisi seluruh route aplikasi
```

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan tugas sekolah. Seluruh hak cipta dimiliki oleh pembuat.

---

<p align="center">Dibuat dengan ❤️ oleh <strong>Vino Hafizh Khairuddin</strong> — XI RPL (41)</p>
