<?php
include '../auth.php';
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    $query = mysqli_query($koneksi, "SELECT * FROM tabel_peminjaman WHERE id_peminjaman = '$id'");
    $data  = mysqli_fetch_assoc($query);
    
    if ($data && $data['status'] == 'dipinjam') {
        $id_buku = $data['id_buku'];
        $tgl_kembali = $data['tgl_kembali'];
        $tgl_pengembalian = date('Y-m-d');
        
        $denda = 0;
        $tgl_kembali_time = strtotime($tgl_kembali);
        $tgl_pengembalian_time = strtotime($tgl_pengembalian);
        
        if ($tgl_pengembalian_time > $tgl_kembali_time) {
            $selisih = $tgl_pengembalian_time - $tgl_kembali_time;
            $hari_terlambat = floor($selisih / (60 * 60 * 24));
            $denda = $hari_terlambat * 1000;
        }
        
        $update_peminjaman = mysqli_query($koneksi, "
            UPDATE tabel_peminjaman 
            SET tgl_pengembalian = '$tgl_pengembalian', 
                denda = '$denda', 
                status = 'dikembalikan' 
            WHERE id_peminjaman = '$id'
        ");
        
        if ($update_peminjaman) {
            mysqli_query($koneksi, "UPDATE tabel_buku SET stok = stok + 1 WHERE id_buku = '$id_buku'");
        }
    }
}

header("Location: index.php");
exit;
?>
