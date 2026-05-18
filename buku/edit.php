<?php include '../auth.php'; ?>
<?php include '../koneksi.php'; 

$id = $_GET['id'];
$data =mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tabel_buku WHERE id_buku = '$id'"));

if (isset($_POST['update'])){
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun_terbit'];
    $stok = $_POST['stok'];

    $query = "UPDATE tabel_buku SET
            judul          ='$judul',
            pengarang      ='$pengarang',
            penerbit       ='$penerbit',
            tahun_terbit   ='$tahun',
            stok           ='$stok'
            WHERE id_buku  ='$id'"; 
    mysqli_query($koneksi, $query); 
    header("Location: index.php");
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
        <input type="number" name="stok" value="<?= $data['stok'] ?>" required>

        <button type="submit" name="update">Update</button>
        <a href="index.php">Batal</a>
    </form>
</div>
</body>
</html>