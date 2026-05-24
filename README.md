# 📚 Library Management System

Aplikasi web **Sistem Manajemen Perpustakaan** berbasis PHP Native & MySQL untuk mengelola data buku, anggota, dan transaksi peminjaman secara digital. Dilengkapi dengan sistem autentikasi multi-role, perhitungan denda otomatis, dan dashboard yang intuitif.

[![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-777BB4?style=flat&logo=php)](https://www.php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-00758F?style=flat&logo=mysql)](https://www.mysql.com)

---

## ✨ Fitur Utama

### 🔐 Autentikasi & Otorisasi
- ✅ Login multi-role (**Admin** dan **Anggota**)
- ✅ Registrasi anggota baru dengan sistem verifikasi admin
- ✅ Session-based authentication dengan middleware
- ✅ Redirect otomatis berdasarkan role pengguna
- ✅ Password hashing dengan MD5

### 📖 Manajemen Buku (Admin)
- ✅ Tambah/Edit/Hapus data buku
- ✅ Kelola stok buku secara otomatis
- ✅ Tampilkan daftar lengkap buku (judul, pengarang, penerbit, tahun terbit, stok)
- ✅ Pencarian dan filter buku

### 👥 Manajemen Anggota (Admin)
- ✅ Lihat daftar seluruh anggota dengan status
- ✅ Tambah/Edit/Hapus anggota
- ✅ **Verifikasi anggota** — Approve atau Tolak pendaftaran baru
- ✅ Kelola status anggota (aktif/nonaktif)

### 📋 Manajemen Peminjaman (Admin)
- ✅ Tambah transaksi peminjaman baru
- ✅ Validasi: pilih anggota aktif dan buku dengan stok tersedia
- ✅ **Stok otomatis berkurang** saat peminjaman
- ✅ **Pengembalian buku** dengan **perhitungan denda otomatis** (Rp 1.000/hari)
- ✅ **Stok otomatis bertambah** saat dikembalikan
- ✅ Hapus/Kelola riwayat transaksi

### 👤 Dashboard Anggota
- ✅ Lihat profil pribadi (nama, KTP, No. HP, email, status)
- ✅ Lihat riwayat peminjaman buku lengkap
- ✅ Monitor status peminjaman (dipinjam/dikembalikan)

---

## 🛠️ Tech Stack

| Komponen       | Teknologi                    |
|----------------|------------------------------|
| **Backend**    | PHP 7.4+ (Procedural)        |
| **Database**   | MySQL 8.0+ (via MySQLi)      |
| **Frontend**   | HTML5, CSS3                  |
| **Web Server** | Apache (XAMPP/Standalone)    |
| **Font**       | Inter (Google Fonts)         |
| **Desain**     | Dark Mode, Custom CSS        |
| **Bahasa**     | Indonesian                   |

---

## 📊 Language Composition
- **PHP**: 63%
- **CSS**: 37%

---

## 📁 Struktur Direktori

```
library-management-system/
│
├── assets/
│   └── css/
│       └── style.css                # Stylesheet utama (dark theme)
│
├── anggota/
│   ├── index.php                    # Daftar anggota (Admin)
│   ├── tambah.php                   # Form tambah anggota
│   ├── edit.php                     # Form edit anggota
│   ├── hapus.php                    # Proses hapus anggota
│   ├── verifikasi.php               # Halaman verifikasi anggota baru
│   └── dashboard.php                # Dashboard anggota (Member)
│
├── buku/
│   ├── index.php                    # Daftar buku dengan pencarian
│   ├── tambah.php                   # Form tambah buku
│   ├── edit.php                     # Form edit buku
│   └── hapus.php                    # Proses hapus buku
│
├── peminjaman/
│   ├── index.php                    # Daftar transaksi peminjaman
│   ├── tambah.php                   # Form tambah peminjaman
│   ├── kembali.php                  # Pengembalian & hitung denda
│   └── hapus.php                    # Proses hapus transaksi
│
├── auth.php                         # Middleware autentikasi
├── index.php                        # Dashboard admin
├── koneksi.php                      # Konfigurasi database
├── login.php                        # Halaman login
├── logout.php                       # Proses logout
├── proses_login.php                 # Validasi autentikasi
├── register.php                     # Registrasi anggota baru
└── README.md                        # Dokumentasi proyek
```

---

## 🗄️ Struktur Database

**Nama Database:** `db_perpustakaan`

### 📌 Tabel `tabel_admin`

| Kolom    | Tipe Data    | Keterangan       |
|----------|--------------|------------------|
| id       | INT (PK, AI) | Primary key      |
| nama     | VARCHAR(100) | Nama admin       |
| username | VARCHAR(50)  | Username unik    |
| password | VARCHAR(32)  | Password (MD5)   |

### 📌 Tabel `tabel_anggota`

| Kolom        | Tipe Data       | Keterangan                       |
|--------------|-----------------|----------------------------------|
| id_anggota   | INT (PK, AI)    | Primary key                      |
| nama_lengkap | VARCHAR(100)    | Nama lengkap anggota             |
| username     | VARCHAR(50)     | Username unik                    |
| no_ktp       | VARCHAR(16)     | Nomor KTP (unik)                 |
| alamat       | TEXT            | Alamat tempat tinggal            |
| no_hp        | VARCHAR(15)     | Nomor HP                         |
| email        | VARCHAR(100)    | Email (opsional)                 |
| password     | VARCHAR(32)     | Password (MD5)                   |
| tgl_daftar   | DATE            | Tanggal pendaftaran              |
| status       | ENUM            | `menunggu`, `aktif`, `nonaktif`  |

### 📌 Tabel `tabel_buku`

| Kolom        | Tipe Data    | Keterangan      |
|--------------|--------------|-----------------|
| id_buku      | INT (PK, AI) | Primary key     |
| judul        | VARCHAR(150) | Judul buku      |
| pengarang    | VARCHAR(100) | Nama pengarang  |
| penerbit     | VARCHAR(100) | Nama penerbit   |
| tahun_terbit | YEAR         | Tahun terbit    |
| stok         | INT          | Jumlah stok     |

### 📌 Tabel `tabel_peminjaman`

| Kolom            | Tipe Data    | Keterangan                           |
|------------------|--------------|--------------------------------------|
| id_peminjaman    | INT (PK, AI) | Primary key                          |
| id_buku          | INT (FK)     | Foreign key → tabel_buku             |
| id_anggota       | INT (FK)     | Foreign key → tabel_anggota          |
| tgl_pinjam       | DATE         | Tanggal peminjaman                   |
| tgl_kembali      | DATE         | Batas tanggal pengembalian (7 hari)  |
| tgl_pengembalian | DATE         | Tanggal pengembalian aktual (NULL)   |
| denda            | INT          | Nominal denda keterlambatan (Rp)     |
| status           | VARCHAR(20)  | `dipinjam` atau `dikembalikan`       |

---

## ⚙️ Instalasi & Konfigurasi

### 📋 Prasyarat
- [XAMPP](https://www.apachefriends.org/) (PHP 7.4+, MySQL/MariaDB)
- Git
- Web browser modern (Chrome, Firefox, Edge, Safari)

### 🚀 Langkah Instalasi

#### 1. Clone Repository
```bash
cd C:\xampp\htdocs
git clone https://github.com/ard4nnn/library-management-system.git
cd library-management-system
```

#### 2. Jalankan XAMPP
- Buka XAMPP Control Panel
- Aktifkan **Apache** dan **MySQL**

#### 3. Buat Database
- Buka `http://localhost/phpmyadmin`
- Buat database baru: `db_perpustakaan`
- Import file SQL (jika tersedia) atau buat tabel secara manual

#### 4. Konfigurasi Database
Edit file `koneksi.php`:
```php
<?php
$host     = "localhost";
$username = "root";
$password = "";
$database = "db_perpustakaan";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>
```

#### 5. Akses Aplikasi
```
http://localhost/library-management-system/
```

---

## 🚀 Cara Penggunaan

### 🔑 Login sebagai Admin
1. Buka halaman login → pilih role **Admin**
2. Masukkan username dan password admin default
3. Anda akan diarahkan ke **Dashboard Admin**

**Admin Default:**
- Username: `admin`
- Password: (sesuai konfigurasi)

### 📝 Registrasi & Login sebagai Anggota
1. Klik **Daftar di sini** dari halaman login
2. Isi form registrasi:
   - Nama lengkap
   - Username
   - Nomor KTP (16 digit)
   - Alamat
   - Nomor HP
   - Email (opsional)
   - Password
3. Tunggu **verifikasi dari Admin**
4. Setelah diverifikasi (status: **aktif**), login dengan role **Anggota**
5. Anda akan diarahkan ke **Dashboard Anggota**

### 📚 Alur Peminjaman Buku
1. Login sebagai **Admin**
2. Buka menu **Data Peminjaman** → **Tambah Peminjaman**
3. Pilih:
   - **Anggota** (status harus aktif)
   - **Buku** (stok harus tersedia > 0)
4. Tentukan tanggal pinjam dan batas kembali (default: 7 hari)
5. Stok buku **otomatis berkurang**
6. Saat pengembalian, sistem **menghitung denda otomatis** jika terlambat

### 💰 Perhitungan Denda
```
Denda = Jumlah Hari Terlambat × Rp 1.000
```
> **Catatan:** Denda hanya berlaku jika tanggal pengembalian melewati batas tanggal kembali

**Contoh:**
- Batas kembali: 10 Mei 2024
- Pengembalian aktual: 17 Mei 2024
- Hari terlambat: 7 hari
- **Denda: 7 × Rp 1.000 = Rp 7.000**

---

## 🎨 Desain & User Interface

Aplikasi menggunakan desain **modern dark mode** dengan fitur:

✨ **Estetika:**
- Tema gelap dengan palet warna hitam (#1a1a1a) dan abu-abu (#2d2d2d)
- Aksen warna biru (#0066cc) dan merah (#ff3333) untuk elemen interaktif
- Font **Inter** dari Google Fonts untuk tipografi modern
- Layout responsif dan bersih

🎭 **Interaksi:**
- Animasi halus (slide-in, hover effects, micro-interactions)
- Tabel data dengan efek hover pada baris
- Notifikasi error dan success dengan animasi
- Tombol dan form yang user-friendly
- Loading states dan feedback visual

---

## 👥 Role & Hak Akses

| Fitur                          | Admin | Anggota |
|--------------------------------|:-----:|:-------:|
| Dashboard Admin                |  ✅   |   ❌    |
| Dashboard Anggota              |  ❌   |   ✅    |
| Kelola Data Buku               |  ✅   |   ❌    |
| Kelola Data Anggota            |  ✅   |   ❌    |
| Verifikasi Anggota Baru        |  ✅   |   ❌    |
| Kelola Peminjaman              |  ✅   |   ❌    |
| Lihat Riwayat Pinjaman Pribadi  |  ❌   |   ✅    |
| Lihat Profil Sendiri           |  ❌   |   ✅    |
| Logout                         |  ✅   |   ✅    |

---

## 🔒 Keamanan

- ✅ Session-based authentication
- ✅ Password hashing dengan MD5
- ✅ Middleware untuk validasi akses berdasarkan role
- ✅ Input validation dan SQL injection prevention
- ✅ CSRF protection pada form

> **Note:** Untuk production, gunakan **bcrypt** atau **password_hash()** sebagai pengganti MD5

---

## 📞 Troubleshooting

### ❌ Koneksi Database Gagal
**Solusi:**
- Pastikan MySQL sudah berjalan
- Cek konfigurasi di `koneksi.php`
- Verifikasi nama database: `db_perpustakaan`

### ❌ Page Blank atau Error 500
**Solusi:**
- Cek error logs di Apache
- Pastikan folder path sudah benar di htdocs
- Restart Apache dan MySQL

### ❌ Login Gagal
**Solusi:**
- Cek username dan password di tabel admin
- Pastikan session sudah enabled di PHP
- Clear browser cookies

---

## 📚 Resources & Dokumentasi

- [PHP Official Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [XAMPP](https://www.apachefriends.org/)
- [MDN Web Docs](https://developer.mozilla.org/)

---

## 📝 Lisensi

Project ini dibuat untuk keperluan pembelajaran dan tugas akademik.

Licensed under the **MIT License** - lihat file [LICENSE](LICENSE) untuk detail.

---

## 👨‍💻 Author

**Created by:** [ard4nnn](https://github.com/ard4nnn)

---

> **Dibuat dengan menggunakan PHP Native & MySQL**
> 
> Last Updated: 2026
