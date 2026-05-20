<?php include '../auth.php'; ?>
<?php include '../koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peminjaman</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
    <h3>Data Peminjaman</h3>
    <a href="tambah.php" class="btn-tambah">+ Tambah Peminjaman</a>
    <table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Anggota</th>
            <th>Judul Buku</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Tgl Pengembalian</th>
            <th>Denda</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "
            SELECT p.*, a.nama_lengkap, b.judul 
            FROM tabel_peminjaman p
            JOIN tabel_anggota a ON p.id_anggota = a.id_anggota
            JOIN tabel_buku b ON p.id_buku = b.id_buku
            ORDER BY p.id_peminjaman DESC
        ");
        
        while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama_lengkap'] ?></td>
                <td><?= $row['judul'] ?></td>
                <td><?= $row['tgl_pinjam'] ?></td>
                <td><?= $row['tgl_kembali'] ?></td>
                <td><?= $row['tgl_pengembalian'] ? $row['tgl_pengembalian'] : '-' ?></td>
                <td>Rp <?= number_format($row['denda'], 0, ',', '.') ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <?php if ($row['status'] == 'dipinjam') { ?>
                        <a href="kembali.php?id=<?= $row['id_peminjaman'] ?>" onclick="return confirm('Yakin kembalikan buku ini?')">Kembalikan</a> |
                    <?php } ?>
                    <a href="hapus.php?id=<?= $row['id_peminjaman'] ?>" onclick="return confirm('yakin hapus transaksi ini?')">Hapus</a>
                </td>
            </tr>
            <?php 
        }
        ?>
    </tbody>
    </table>
    <br>
    <a href="../index.php"><-Kembali ke menu</a>
</div>
</body>
</html>
