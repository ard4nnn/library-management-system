<?php include '../auth.php'; ?>
<?php include '../koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Anggota</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Data Anggota</h2>
        <a href="../logout.php">Logout</a>
    </div>

    <a href="tambah.php" class="btn-tambah">+ Tambah Anggota</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No. KTP</th>
                <th>No. HP</th>
                <th>Tgl Daftar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no    = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM tabel_anggota");

            while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama_lengkap'] ?></td>
                <td><?= $row['no_ktp'] ?></td>
                <td><?= $row['no_hp'] ?></td>
                <td><?= $row['tgl_daftar'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id_anggota'] ?>">Edit</a> |
                    <a href="hapus.php?id=<?= $row['id_anggota'] ?>"
                       onclick="return confirm('Yakin hapus anggota ini?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <br>
    <a href="../index.php">← Kembali ke Menu</a>
</div>

</body>
</html>