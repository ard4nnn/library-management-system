<?php include '../auth.php'; ?>
<?php include '../koneksi.php';

if (isset($_GET['approve'])) {
    $id = $_GET['approve'];
    mysqli_query($koneksi, 
        "UPDATE tabel_anggota SET status = 'aktif' WHERE id_anggota = $id"
    );
    header('Location: verifikasi.php');
    exit;
}

if (isset($_GET['tolak'])) {
    $id = $_GET['tolak'];
    mysqli_query($koneksi, 
        "UPDATE tabel_anggota SET status = 'nonaktif' WHERE id_anggota = $id"
    );
    header('Location: verifikasi.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Anggota</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Verifikasi Anggota</h2>
        <a href="../logout.php">Logout</a>
    </div>

    <h3>Anggota Menunggu Verifikasi</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No. KTP</th>
                <th>No. HP</th>
                <th>Email</th>
                <th>Tgl Daftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no    = 1;
            $query = mysqli_query($koneksi, 
                "SELECT * FROM tabel_anggota WHERE status = 'menunggu'"
            );

            if (mysqli_num_rows($query) == 0) { ?>
                <tr>
                    <td colspan="7" style="text-align:center">
                        Tidak ada anggota yang menunggu verifikasi
                    </td>
                </tr>
            <?php } else {
                while ($row = mysqli_fetch_assoc($query)) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama_lengkap'] ?></td>
                    <td><?= $row['no_ktp'] ?></td>
                    <td><?= $row['no_hp'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['tgl_daftar'] ?></td>
                    <td>
                        <a href="verifikasi.php?approve=<?= $row['id_anggota'] ?>"
                           onclick="return confirm('Approve anggota ini?')">Approve</a> |
                        <a href="verifikasi.php?tolak=<?= $row['id_anggota'] ?>"
                           onclick="return confirm('Tolak anggota ini?')">Tolak</a>
                    </td>
                </tr>
                <?php }
            } ?>
        </tbody>
    </table>

    <br>
    <a href="../index.php">← Kembali ke Menu</a>
</div>

</body>
</html>