<?php include '../koneksi.php'; 

if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun_terbit'];
    $stok = $_POST['stok'];

$query = "INSERT INTO tabel_buku (judul, pengarang, penerbit, tahun_terbit, stok)
              VALUES ('$judul', '$pengarang', '$penerbit', '$tahun', '$stok')";
    
    mysqli_query($koneksi, $query);    
    header("Location: index.php");
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
        <input type="number" name="stok" required>
        <button type="submit" name="simpan">Simpan</button>
        <a href="index.php">Batal</a>
    </form>
</div>
</body>
</html>

