<?php include '../auth.php'; ?>
<?php include '../koneksi.php';

$id   = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, 
    "SELECT * FROM tabel_anggota WHERE id_anggota = $id"
));

if (isset($_POST['update'])) {
    $nama   = $_POST['nama_lengkap'];
    $no_ktp = $_POST['no_ktp'];
    $alamat = $_POST['alamat'];
    $no_hp  = $_POST['no_hp'];
    $email  = $_POST['email'];
    $status = $_POST['status'];

    if (!empty($_POST['password'])) {
        $password = MD5($_POST['password']);
        $query = "UPDATE tabel_anggota SET
                    nama_lengkap = '$nama',
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