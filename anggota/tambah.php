<?php include '../auth.php'; ?>
<?php include '../koneksi.php';

if (isset($_POST['simpan'])) {
    $nama     = $_POST['nama_lengkap'];
    $no_ktp   = $_POST['no_ktp'];
    $alamat   = $_POST['alamat'];
    $no_hp    = $_POST['no_hp'];
    $email    = $_POST['email'];
    $password = MD5($_POST['password']);
    $tgl      = date('Y-m-d');
    $status   = $_POST['status'];

    $cek = mysqli_query($koneksi,
        "SELECT * FROM tabel_anggota WHERE no_ktp = '$no_ktp'"
    );

    if (mysqli_num_rows($cek) > 0) {
        header('Location: tambah.php?error=ktp');
        exit;
    }

    $query = "INSERT INTO tabel_anggota
                (nama_lengkap, no_ktp, alamat, no_hp, email, password, tgl_daftar, status)
              VALUES
                ('$nama', '$no_ktp', '$alamat', '$no_hp', '$email', '$password', '$tgl', '$status')";

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
    <?php } ?>

    <form method="POST">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" required>

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