# AutoRent App 🚗

AutoRent adalah platform aplikasi sewa mobil berbasis web yang modern dan responsif. Dibangun menggunakan **Laravel**, aplikasi ini menyediakan standar kenyamanan dan kemudahan pengelolaan baik untuk penyewa maupun admin rental.

## 🌟 Fitur Utama

### 👤 Fitur Pengguna (Penyewa)
- **Katalog Kendaraan**: Menampilkan daftar mobil yang tersedia dengan informasi lengkap (merk, kategori, harga sewa, dan status ketersediaan).
- **Sistem Booking & Checkout**: Form pemesanan yang mudah, terintegrasi dengan perhitungan total biaya secara otomatis berdasarkan jumlah hari sewa.
- **Manajemen Riwayat Sewa**: Pengguna dapat melihat daftar transaksi mereka beserta status (Aktif, Selesai, Dibatalkan).
- **Autentikasi Aman**: Registrasi dan login pengguna dengan manajemen profil.

### 🛡️ Fitur Admin (Dashboard)
- **Manajemen Kendaraan**: Tambah, edit, dan hapus data mobil di katalog.
- **Manajemen Pelanggan**: Mendata informasi pelanggan yang pernah melakukan penyewaan.
- **Kelola Transaksi (Booking)**: Memantau dan memperbarui status sewa pelanggan.
- **Kelola Pembayaran**: Mengkonfirmasi metode pembayaran pelanggan (Transfer Bank, E-Wallet, Cash) dan verifikasi bukti bayar.
- **Laporan Ringkas**: Dashboard statistik dengan insight seputar jumlah kendaran, pelanggan, dan transaksi terbaru.

## 🛠️ Teknologi yang Digunakan
- **Framework**: [Laravel 11](https://laravel.com/)
- **Frontend**: Blade Templating Engine, Bootstrap 5, Vanilla CSS
- **Database**: MySQL / SQLite (Sesuai Konfigurasi)
- **Ikon**: Bootstrap Icons

## 🚀 Panduan Instalasi (Development Lokal)

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer Anda:

1. **Clone repository ini:**
   ```bash
   git clone https://github.com/vinohfzh/autorent-app.git
   cd autorent-app
   ```

2. **Install dependency PHP:**
   ```bash
   composer install
   ```

3. **Install dependency NPM (Jika diperlukan):**
   ```bash
   npm install
   npm run build
   ```

4. **Konfigurasi Environment:**
   Salin file `.env.example` menjadi `.env` lalu sesuaikan konfigurasi database Anda.
   ```bash
   cp .env.example .env
   ```

5. **Generate App Key:**
   ```bash
   php artisan key:generate
   ```

6. **Migrasi Database & Seeder:**
   ```bash
   php artisan migrate --seed
   ```

7. **Link Storage:**
   Agar gambar/foto kendaraan dapat diakses:
   ```bash
   php artisan storage:link
   ```

8. **Jalankan Server Lokal:**
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses melalui `http://localhost:8000`

## 📄 Lisensi
Project ini adalah perangkat lunak sumber terbuka (open-sourced software) dan dapat digunakan sesuai kebutuhan.
