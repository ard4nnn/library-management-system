<?php include '../auth.php'; ?>
<?php include '../koneksi.php'; 

$id = (int)$_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tabel_buku WHERE id_buku = '$id'"));

if (isset($_POST['update'])){
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $pengarang = mysqli_real_escape_string($koneksi, $_POST['pengarang']);
    $penerbit = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
    $tahun = (int)$_POST['tahun_terbit'];
    $stok = (int)$_POST['stok'];

    $query = "UPDATE tabel_buku SET
            judul          ='$judul',
            pengarang      ='$pengarang',
            penerbit       ='$penerbit',
            tahun_terbit   ='$tahun',
            stok           ='$stok'
            WHERE id_buku  ='$id'"; 
    mysqli_query($koneksi, $query); 
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <h2>Edit Buku</h2>
    <form method="POST">
        <label>Judul Buku</label>
        <input type="text" name="judul" value="<?= $data['judul'] ?>" required>

        <label>Pengarang</label>
        <input type="text" name="pengarang" value="<?= $data['pengarang'] ?>" required>

        <label>Penerbit</label>
        <input type="text" name="penerbit" value="<?= $data['penerbit'] ?>" required>

        <label>Tahun Terbit</label>
        <input type="number" name="tahun_terbit" value="<?= $data['tahun_terbit'] ?>" required>

        <label>Stok</label>
        <input type="number" name="stok" value="<?= $data['stok'] ?>" min="0" required>

        <button type="submit" name="update">Update</button>
        <a href="index.php">Batal</a>
    </form>
</div>
</body>
</html>