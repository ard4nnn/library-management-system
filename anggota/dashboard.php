<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit;
}

if ($_SESSION['role'] == 'admin') {
    header('Location: ../index.php');
    exit;
}

include '../koneksi.php';

$id_anggota = $_SESSION['id_anggota'];

$data = mysqli_fetch_assoc(mysqli_query($koneksi,
    "SELECT * FROM tabel_anggota WHERE id_anggota = $id_anggota"
));

$peminjaman = mysqli_query($koneksi,
    "SELECT p.*, b.judul, b.pengarang 
     FROM tabel_peminjaman p
     JOIN tabel_buku b ON p.id_buku = b.id_buku
     WHERE p.id_anggota = $id_anggota
     ORDER BY p.tgl_pinjam DESC"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Anggota</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Perpustakaan Umum</h2>
        <div>
            <span><?= $_SESSION['user'] ?></span> |
            <a href="../logout.php">Logout</a>
        </div>
    </div>

    <h3>Selamat datang, <?= $data['nama_lengkap'] ?>! </h3>

    <div class="info-card">
        <h4>Data Saya</h4>
        <p><strong>Nama</strong>: <?= $data['nama_lengkap'] ?></p>
        <p><strong>No. KTP</strong>: <?= $data['no_ktp'] ?></p>
        <p><strong>No. HP</strong>: <?= $data['no_hp'] ?></p>
        <p><strong>Email</strong>: <?= $data['email'] ?? '-' ?></p>
        <p><strong>Status</strong>: <?= $data['status'] ?></p>
    </div>

    <h4>Riwayat Peminjaman Saya</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if (mysqli_num_rows($peminjaman) == 0) { ?>
                <tr>
                    <td colspan="6" style="text-align:center">
                        Belum ada riwayat peminjaman
                    </td>
                </tr>
            <?php } else {
                while ($row = mysqli_fetch_assoc($peminjaman)) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['judul'] ?></td>
                    <td><?= $row['pengarang'] ?></td>
                    <td><?= $row['tgl_pinjam'] ?></td>
                    <td><?= $row['tgl_kembali'] ?></td>
                    <td><?= $row['status'] ?></td>
                </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</div>

</body>
</html>