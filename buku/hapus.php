<?php include '../auth.php'; ?>
<?php include '../koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM tabel_buku WHERE id_buku = $id");
header("Location: index.php");
?>