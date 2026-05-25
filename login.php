<?php
session_start();

if (isset($_SESSION['user'])) {
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        header('Location: index.php');
    } else {
        header('Location: anggota/dashboard.php');
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Perpustakaan</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container-login">
    <h2>Perpustakaan Digital</h2>
    <p>Silahkan Login untuk melanjutkan</p>

   <?php if (isset($_GET['error'])) { 
    if ($_GET['error'] == 'menunggu') { ?>
        <div class="error">Akun kamu belum diverifikasi admin!</div>
    <?php } elseif ($_GET['error'] == 'nonaktif') { ?>
        <div class="error">Akun kamu telah dinonaktifkan!</div>
    <?php } else { ?>
        <div class="error">Username/Password salah!</div>
    <?php } 
} ?>
        <?php if (isset($_GET['success']) && $_GET['success'] == 'register') { ?>
            <div class="success">Pendaftaran berhasil! Tunggu verifikasi dari admin.</div>
        <?php } ?>
        <form method="POST" action="proses.login.php">
            <label>Role</label>
            <select name="role">
                <option value="admin">Admin</option>
                <option value="anggota">Anggota</option>
            </select>
            
            <label>Username / No.KTP</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </form>
</div>

</body>
</html>