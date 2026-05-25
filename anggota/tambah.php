<?php include '../auth.php'; ?>
<?php include '../koneksi.php';

if (isset($_POST['simpan'])) {
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $no_ktp   = mysqli_real_escape_string($koneksi, $_POST['no_ktp']);
    $alamat   = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_hp    = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = MD5($_POST['password']);
    $tgl      = date('Y-m-d');
    $status   = mysqli_real_escape_string($koneksi, $_POST['status']);

    $cek = mysqli_query($koneksi,
        "SELECT * FROM tabel_anggota WHERE no_ktp = '$no_ktp' OR username = '$username'"
    );

    if (mysqli_num_rows($cek) > 0) {
        $row_cek = mysqli_fetch_assoc($cek);
        if ($row_cek['no_ktp'] == $no_ktp) {
            header('Location: tambah.php?error=ktp');
        } else {
            header('Location: tambah.php?error=username');
        }
        exit;
    }

    $query = "INSERT INTO tabel_anggota
                (nama_lengkap, username, no_ktp, alamat, no_hp, email, password, tgl_daftar, status)
              VALUES
                ('$nama', '$username', '$no_ktp', '$alamat', '$no_hp', '$email', '$password', '$tgl', '$status')";

    mysqli_query($koneksi, $query);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Anggota</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <h2>+ Tambah Anggota</h2>

    <?php if (isset($_GET['error']) && $_GET['error'] == 'ktp') { ?>
        <div class="error">No. KTP sudah terdaftar!</div>
    <?php } elseif (isset($_GET['error']) && $_GET['error'] == 'username') { ?>
        <div class="error">Username sudah digunakan!</div>
    <?php } ?>

    <form method="POST">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" required>

        <label>Username</label>
        <input type="text" name="username" required>

        <label>No. KTP</label>
        <input type="text" name="no_ktp" maxlength="16" required>

        <label>Alamat</label>
        <textarea name="alamat" required></textarea>

        <label>No. HP</label>
        <input type="text" name="no_hp" required>

        <label>Email</label>
        <input type="email" name="email">

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Status</label>
        <select name="status">
            <option value="aktif">Aktif</option>
            <option value="menunggu">Menunggu</option>
            <option value="nonaktif">Nonaktif</option>
        </select>

        <button type="submit" name="simpan">Simpan</button>
        <a href="index.php">Batal</a>
    </form>
</div>

</body>
</html>