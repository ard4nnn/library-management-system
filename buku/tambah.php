<?php include '../auth.php'; ?>
<?php include '../koneksi.php'; 

if (isset($_POST['simpan'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $pengarang = mysqli_real_escape_string($koneksi, $_POST['pengarang']);
    $penerbit = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
    $tahun = (int)$_POST['tahun_terbit'];
    $stok = (int)$_POST['stok'];

    $query = "INSERT INTO tabel_buku (judul, pengarang, penerbit, tahun_terbit, stok)
              VALUES ('$judul', '$pengarang', '$penerbit', '$tahun', '$stok')";
    
    mysqli_query($koneksi, $query);    
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
    <h3>+ Tambah Buku</h3>
    <form method="post">
        <label>Judul Buku :</label>
        <input type="text" name="judul" required>
        <label>Pengarang :</label>
        <input type="text" name="pengarang" required>
        <label>Penerbit :</label>
        <input type="text" name="penerbit" required>
        <label>Tahun Terbit :</label>
        <input type="number" name="tahun_terbit" required>
        <label>Stok :</label>
        <input type="number" name="stok" min="0" required>
        <button type="submit" name="simpan">Simpan</button>
        <a href="index.php">Batal</a>
    </form>
</div>
</body>
</html>

