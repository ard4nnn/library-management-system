<?php 
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if ($_SESSION['role'] == 'anggota') {
    header('Location: anggota/dashboard.php');
    exit;
} 

?>
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
    <div class="header">
        <h2>Sistem Manajemen Perpustakaan</h2>
        <div>
            <span><?= $_SESSION['user']?></span>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <h3>Selamat datang, <?= $_SESSION['user']?>!</h3>
    <p>Kelola Perpustakaan melalui menu dibawah ini</p>

    <div class="menu">
        <a href="buku/index.php" class="card">
            <span>Data Buku</span>
        </a>
        <a href="anggota/index.php" class="card">
            <span>Data Anggota</span>
        </a>
        <a href="peminjaman/index.php" class="card">
            <span>Data Peminjaman</span>
        </a>
        <a href="anggota/verifikasi.php" class="card">
            <span>Verifikasi Anggota</span> 
        </a>
    </div>
</div>
</body>
</html>