<?php
session_start();
include 'koneksi.php';

$role     = mysqli_real_escape_string($koneksi, $_POST['role']);
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = MD5($_POST['password']);

if ($role == 'admin') {

    $query = mysqli_query($koneksi, 
        "SELECT * FROM tabel_admin 
         WHERE username = '$username' AND password = '$password'"
    );

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['user'] = $data['nama'];
        $_SESSION['role'] = 'admin';
        header('Location: index.php');
    } else {
        header('Location: login.php?error=1');
    }

} else {
    $query = mysqli_query($koneksi, 
        "SELECT * FROM tabel_anggota 
         WHERE (no_ktp = '$username' OR username = '$username') 
         AND password = '$password'"
    );

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        if ($data['status'] == 'menunggu') {
            header('Location: login.php?error=menunggu');
        } elseif ($data['status'] == 'nonaktif') {
            header('Location: login.php?error=nonaktif');
        } else {
            $_SESSION['user']       = $data['nama_lengkap'];
            $_SESSION['role']       = 'anggota';
            $_SESSION['id_anggota'] = $data['id_anggota'];
            header('Location: anggota/dashboard.php');
        }
    } else {
        header('Location: login.php?error=1');
    }

}
exit;
?>