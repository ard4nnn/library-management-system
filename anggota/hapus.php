<?php include '../auth.php'; ?>
<?php include '../koneksi.php';

$id = (int)$_GET['id'];

mysqli_query($koneksi, "DELETE FROM tabel_anggota WHERE id_anggota = $id");

header('Location: index.php');
exit;
?>