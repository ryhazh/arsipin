

# Arsipin - Sistem Informasi Perpustakaan

Arsipin adalah sistem informasi perpustakaan yang dirancang untuk memudahkan pengelolaan dan peminjaman buku. Aplikasi ini dibangun menggunakan framework PHP Laravel dengan antarmuka yang user-friendly dan mudah digunakan.

## Fitur Utama

### Untuk Pustakawan
- Manajemen Buku
  - Tambah, edit, dan hapus buku
  - Upload gambar sampul buku
  - Kelola kategori dan genre buku
  - Pantau stok buku yang tersedia

- Manajemen Peminjaman
  - Catat peminjaman dan pengembalian buku
  - Lacak status peminjaman (Dipinjam, Terlambat, Dikembalikan)
  - Atur tanggal jatuh tempo
  - Notifikasi untuk buku yang terlambat

- Laporan dan Statistik
  - Lihat riwayat peminjaman
  - Filter berdasarkan tanggal dan status
  - Pantau buku yang sering dipinjam

### Untuk Pengguna
- Pencarian Buku
  - Cari buku berdasarkan judul, penulis, atau kategori
  - Filter berdasarkan genre
  - Lihat detail dan ketersediaan buku

- Manajemen Akun
  - Lihat riwayat peminjaman
  - Pantau tanggal pengembalian
  - Update profil pengguna

## Teknologi yang Digunakan
- Laravel 11
- MySQL
- Bootstrap 5
- Tabler UI

## Instalasi

1. Clone repositori ini
```bash
git clone https://github.com/username/arsipin.git
```

2. Install dependensi
```bash
composer install
```

3. Buat file .env dan konfigurasi database
```bash
cp .env.example .env
```

4. Generate key aplikasi
```bash
php artisan key:generate
```

5. Jalankan migrasi dan seed
```bash
php artisan migrate --seed
```

6. Jalankan aplikasi
```bash
php artisan serve
```


