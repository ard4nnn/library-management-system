<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Umum</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="container">
        <h1> Perpustakaan Digital</h1>
        <p>Selamat datang! Pilih menu di bawah ini:</p>

        <div class="menu">
            <a href="buku/index.php" class="card">
                <br><span>Data Buku</span></br>
            </a>
            <a href="anggota/index.php" class="card">
                <br><span>Data Anggota</span></br>
            </a>
            <a href="peminjaman/index.php" class="card">
                <br><span>Data Peminjaman</span></br>
            </a>
        </div>
    </div>

</body>
</html>