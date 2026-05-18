<?php include '../auth.php'; ?>
<?php include '../koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
    <h3>Data Buku</h3>
    <a href="tambah.php" class="btn-tambah">+ Tambah Buku</a>
    <table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM tabel_buku");
        while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['judul'] ?></td>
                <td><?= $row['pengarang'] ?></td>
                <td><?= $row['penerbit'] ?></td>
                <td><?= $row['tahun_terbit'] ?></td>
                <td><?= $row['stok'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id_buku'] ?>">Edit</a>
                    <a href="hapus.php?id=<?= $row['id_buku'] ?>"
                    onclick=return confirm('yakin hapus buku ini?')>Hapus</a>
                </td>
            </tr>
            <?php }
            ?>
        </tbody>
    </table>

    <br>
    <a href="../index.php"><-Kembali ke menu</a>
</div>
</body>
</html>