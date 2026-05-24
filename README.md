# 📚 Sistem Manajemen Perpustakaan

Aplikasi web **Sistem Manajemen Perpustakaan** berbasis PHP Native & MySQL untuk mengelola data buku, anggota, dan transaksi peminjaman secara digital. Dilengkapi dengan sistem autentikasi multi-role (Admin & Anggota) serta antarmuka modern bertema dark mode.

---

## ✨ Fitur Utama

### 🔐 Autentikasi & Otorisasi
- Login multi-role (**Admin** dan **Anggota**)
- Registrasi anggota baru dengan sistem verifikasi admin
- Session-based authentication
- Redirect otomatis berdasarkan role pengguna

### 📖 Manajemen Buku (Admin)
- Tambah data buku baru
- Edit informasi buku
- Hapus data buku
- Menampilkan daftar buku (judul, pengarang, penerbit, tahun terbit, stok)

### 👥 Manajemen Anggota (Admin)
- Lihat daftar seluruh anggota
- Tambah anggota baru
- Edit data anggota
- Hapus anggota
- **Verifikasi anggota** — Approve atau Tolak pendaftaran anggota baru

### 📋 Manajemen Peminjaman (Admin)
- Tambah transaksi peminjaman baru
- Pilih anggota aktif dan buku yang tersedia (stok > 0)
- Otomatis mengurangi stok buku saat dipinjam
- Pengembalian buku dengan **perhitungan denda otomatis** (Rp 1.000/hari keterlambatan)
- Otomatis menambah stok buku saat dikembalikan
- Hapus riwayat transaksi

### 👤 Dashboard Anggota
- Lihat data profil pribadi (nama, No. KTP, No. HP, email, status)
- Lihat riwayat peminjaman buku pribadi

---

## 🛠️ Tech Stack

| Komponen       | Teknologi                          |
| -------------- | ---------------------------------- |
| **Backend**    | PHP Native (Prosedural)            |
| **Database**   | MySQL (via MySQLi)                 |
| **Frontend**   | HTML5, CSS3                        |
| **Web Server** | Apache (XAMPP)                     |
| **Font**       | Inter (Google Fonts)               |
| **Desain**     | Dark Mode, Custom CSS, Animasi     |

---

## 📁 Struktur Direktori

```
library-management-system/
│
├── assets/
│   └── css/
│       └── style.css              # Stylesheet utama (dark theme)
│
├── anggota/
│   ├── index.php                  # Daftar anggota (Admin)
│   ├── tambah.php                 # Form tambah anggota
│   ├── edit.php                   # Form edit anggota
│   ├── hapus.php                  # Proses hapus anggota
│   ├── verifikasi.php             # Halaman verifikasi anggota baru
│   └── dashboard.php              # Dashboard anggota (Member)
│
├── buku/
│   ├── index.php                  # Daftar buku
│   ├── tambah.php                 # Form tambah buku
│   ├── edit.php                   # Form edit buku
│   └── hapus.php                  # Proses hapus buku
│
├── peminjaman/
│   ├── index.php                  # Daftar transaksi peminjaman
│   ├── tambah.php                 # Form tambah peminjaman
│   ├── kembali.php                # Proses pengembalian & hitung denda
│   └── hapus.php                  # Proses hapus transaksi
│
├── auth.php                       # Middleware autentikasi (admin only)
├── index.php                      # Halaman utama / dashboard admin
├── koneksi.php                    # Konfigurasi koneksi database
├── login.php                      # Halaman login
├── logout.php                     # Proses logout
├── proses.login.php               # Proses autentikasi login
├── register.php                   # Halaman & proses registrasi anggota
└── README.md
```

---

## 🗄️ Struktur Database

**Nama Database:** `db_perpustakaan`

### Tabel `tabel_admin`

| Kolom      | Tipe Data    | Keterangan          |
| ---------- | ------------ | ------------------- |
| id         | INT (PK, AI) | Primary key         |
| nama       | VARCHAR      | Nama admin          |
| username   | VARCHAR      | Username login      |
| password   | VARCHAR      | Password (MD5 hash) |

### Tabel `tabel_anggota`

| Kolom         | Tipe Data    | Keterangan                              |
| ------------- | ------------ | --------------------------------------- |
| id_anggota    | INT (PK, AI) | Primary key                             |
| nama_lengkap  | VARCHAR      | Nama lengkap anggota                    |
| username      | VARCHAR      | Username login                          |
| no_ktp        | VARCHAR(16)  | Nomor KTP (unik)                        |
| alamat        | TEXT         | Alamat tempat tinggal                   |
| no_hp         | VARCHAR      | Nomor HP                                |
| email         | VARCHAR      | Email (opsional)                        |
| password      | VARCHAR      | Password (MD5 hash)                     |
| tgl_daftar    | DATE         | Tanggal pendaftaran                     |
| status        | ENUM/VARCHAR | Status: `menunggu`, `aktif`, `nonaktif` |

### Tabel `tabel_buku`

| Kolom        | Tipe Data    | Keterangan       |
| ------------ | ------------ | ---------------- |
| id_buku      | INT (PK, AI) | Primary key      |
| judul        | VARCHAR      | Judul buku       |
| pengarang    | VARCHAR      | Nama pengarang   |
| penerbit     | VARCHAR      | Nama penerbit    |
| tahun_terbit | YEAR/VARCHAR | Tahun terbit     |
| stok         | INT          | Jumlah stok buku |

### Tabel `tabel_peminjaman`

| Kolom            | Tipe Data    | Keterangan                              |
| ---------------- | ------------ | --------------------------------------- |
| id_peminjaman    | INT (PK, AI) | Primary key                             |
| id_buku          | INT (FK)     | Relasi ke `tabel_buku`                  |
| id_anggota       | INT (FK)     | Relasi ke `tabel_anggota`               |
| tgl_pinjam       | DATE         | Tanggal peminjaman                      |
| tgl_kembali      | DATE         | Batas tanggal pengembalian              |
| tgl_pengembalian | DATE         | Tanggal pengembalian aktual (nullable)  |
| denda            | INT          | Nominal denda keterlambatan             |
| status           | VARCHAR      | Status: `dipinjam` / `dikembalikan`     |

---

## ⚙️ Instalasi & Konfigurasi

### Prasyarat
- [XAMPP](https://www.apachefriends.org/) (PHP 7.4+ & MySQL/MariaDB)
- Web browser modern

### Langkah Instalasi

1. **Clone repository** ke direktori `htdocs` XAMPP:
   ```bash
   cd C:\xampp\htdocs
   git clone https://github.com/username/library-management-system.git
   ```

2. **Jalankan XAMPP**, aktifkan modul **Apache** dan **MySQL**.

3. **Buat database** melalui phpMyAdmin (`http://localhost/phpmyadmin`):
   - Buat database baru dengan nama: `db_perpustakaan`
   - Import file SQL (jika tersedia), atau buat tabel secara manual sesuai struktur di atas.

4. **Konfigurasi koneksi database** pada file `koneksi.php`:
   ```php
   $host     = "localhost";
   $username = "root";
   $password = "";
   $database = "db_perpustakaan";
   ```

5. **Akses aplikasi** melalui browser:
   ```
   http://localhost/library-management-system/
   ```

---

## 🚀 Cara Penggunaan

### Login sebagai Admin
1. Buka halaman login
2. Pilih role **Admin**
3. Masukkan username dan password admin
4. Anda akan diarahkan ke **Dashboard Admin**

### Login sebagai Anggota
1. Buka halaman login → klik **Daftar di sini**
2. Isi form registrasi (nama, username, No. KTP, alamat, No. HP, email, password)
3. Tunggu **verifikasi dari Admin**
4. Setelah diverifikasi, login dengan role **Anggota**
5. Anda akan diarahkan ke **Dashboard Anggota**

### Alur Peminjaman Buku
1. Admin membuka menu **Data Peminjaman** → **Tambah Peminjaman**
2. Pilih anggota (yang sudah aktif) dan buku (yang stoknya tersedia)
3. Tentukan tanggal pinjam dan batas tanggal kembali (default: 7 hari)
4. Stok buku otomatis berkurang
5. Saat dikembalikan, sistem menghitung denda jika melewati batas waktu

### Perhitungan Denda
```
Denda = Jumlah Hari Terlambat × Rp 1.000
```
> Denda hanya berlaku jika tanggal pengembalian melewati batas tanggal kembali.

---

## 🎨 Desain & UI

Aplikasi ini menggunakan desain **dark mode** yang modern dengan fitur:
- Tema gelap dengan palet warna hitam dan abu-abu
- Aksen warna biru dan merah pada elemen interaktif
- Animasi halus (slide-in, hover effects, micro-interactions)
- Font **Inter** dari Google Fonts
- Layout responsif dan bersih
- Tabel data dengan efek hover pada baris
- Notifikasi error dan success dengan animasi

---

## 👥 Role & Hak Akses

| Fitur                   | Admin | Anggota |
| ----------------------- | :---: | :-----: |
| Dashboard Admin         |  ✅   |   ❌    |
| Dashboard Anggota       |  ❌   |   ✅    |
| Kelola Data Buku        |  ✅   |   ❌    |
| Kelola Data Anggota     |  ✅   |   ❌    |
| Verifikasi Anggota      |  ✅   |   ❌    |
| Kelola Peminjaman       |  ✅   |   ❌    |
| Lihat Riwayat Pinjaman  |  ❌   |   ✅    |
| Lihat Profil Sendiri    |  ❌   |   ✅    |

---

## 📝 Lisensi

Project ini dibuat untuk keperluan pembelajaran dan tugas akademik.

---

> **Dibuat dengan ❤️ menggunakan PHP Native & MySQL**