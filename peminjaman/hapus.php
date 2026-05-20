<?php
include '../auth.php';
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    $query = mysqli_query($koneksi, "SELECT * FROM tabel_peminjaman WHERE id_peminjaman = '$id'");
    $data  = mysqli_fetch_assoc($query);
    
    if ($data) {
        $id_buku = $data['id_buku'];
        $status  = $data['status'];
        
        $delete = mysqli_query($koneksi, "DELETE FROM tabel_peminjaman WHERE id_peminjaman = '$id'");
        
        if ($delete && $status == 'dipinjam') {
            mysqli_query($koneksi, "UPDATE tabel_buku SET stok = stok + 1 WHERE id_buku = '$id_buku'");
        }
    }
}

header("Location: index.php");
exit;
?>
