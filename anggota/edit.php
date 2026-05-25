<?php include '../auth.php'; ?>
<?php include '../koneksi.php';

$id   = (int)$_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, 
    "SELECT * FROM tabel_anggota WHERE id_anggota = $id"
));

if (isset($_POST['update'])) {
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $no_ktp   = mysqli_real_escape_string($koneksi, $_POST['no_ktp']);
    $alamat   = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_hp    = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $status   = mysqli_real_escape_string($koneksi, $_POST['status']);

    if (!empty($_POST['password'])) {
        $password = MD5($_POST['password']);
        $query = "UPDATE tabel_anggota SET
                    nama_lengkap = '$nama',
                    username     = '$username',
                    no_ktp       = '$no_ktp',
                    alamat       = '$alamat',
                    no_hp        = '$no_hp',
                    email        = '$email',
                    password     = '$password',
                    status       = '$status'
                  WHERE id_anggota = $id";
    } else {
        $query = "UPDATE tabel_anggota SET
                    nama_lengkap = '$nama',
                    username     = '$username',
                    no_ktp       = '$no_ktp',
                    alamat       = '$alamat',
                    no_hp        = '$no_hp',
                    email        = '$email',
                    status       = '$status'
                  WHERE id_anggota = $id";
    }

    mysqli_query($koneksi, $query);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Anggota</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <h2>Edit Anggota</h2>

    <form method="POST">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" 
               value="<?= $data['nama_lengkap'] ?>" required>

        <label>Username</label>
        <input type="text" name="username" 
               value="<?= $data['username'] ?>" required>

        <label>No. KTP</label>
        <input type="text" name="no_ktp" 
               value="<?= $data['no_ktp'] ?>" maxlength="16" required>

        <label>Alamat</label>
        <textarea name="alamat" required><?= $data['alamat'] ?></textarea>

        <label>No. HP</label>
        <input type="text" name="no_hp" 
               value="<?= $data['no_hp'] ?>" required>

        <label>Email</label>
        <input type="email" name="email" 
               value="<?= $data['email'] ?>">

        <label>Password Baru (kosongkan jika tidak diubah)</label>
        <input type="password" name="password">

        <label>Status</label>
        <select name="status">
            <option value="aktif" <?= $data['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
            <option value="menunggu" <?= $data['status'] == 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
            <option value="nonaktif" <?= $data['status'] == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
        </select>

        <button type="submit" name="update">Update</button>
        <a href="index.php">Batal</a>
    </form>
</div>

</body>
</html>