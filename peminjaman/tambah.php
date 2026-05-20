<?php include '../auth.php'; ?>
<?php include '../koneksi.php'; 

if (isset($_POST['simpan'])) {
    $id_anggota = mysqli_real_escape_string($koneksi, $_POST['id_anggota']);
    $id_buku    = mysqli_real_escape_string($koneksi, $_POST['id_buku']);
    $tgl_pinjam = mysqli_real_escape_string($koneksi, $_POST['tgl_pinjam']);
    $tgl_kembali= mysqli_real_escape_string($koneksi, $_POST['tgl_kembali']);
    
    $check_book = mysqli_query($koneksi, "SELECT stok FROM tabel_buku WHERE id_buku = '$id_buku'");
    $book_data  = mysqli_fetch_assoc($check_book);
    
    if ($book_data && $book_data['stok'] > 0) {
        $query = "INSERT INTO tabel_peminjaman (id_buku, id_anggota, tgl_pinjam, tgl_kembali, status)
                  VALUES ('$id_buku', '$id_anggota', '$tgl_pinjam', '$tgl_kembali', 'dipinjam')";
        
        if (mysqli_query($koneksi, $query)) {
            mysqli_query($koneksi, "UPDATE tabel_buku SET stok = stok - 1 WHERE id_buku = '$id_buku'");
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal memproses peminjaman: " . mysqli_error($koneksi);
        }
    } else {
        $error = "Stok buku habis!";
    }
}

$default_tgl_pinjam = date('Y-m-d');
$default_tgl_kembali = date('Y-m-d', strtotime('+7 days'));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Peminjaman</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
    <h3>+ Tambah Peminjaman Buku</h3>
    
    <?php if (isset($error)) { ?>
        <p style="color: red;"><?= $error ?></p>
    <?php } ?>

    <form method="post">
        <label>Pilih Anggota :</label>
        <select name="id_anggota" required>
            <option value="">-- Pilih Anggota --</option>
            <?php
            $query_anggota = mysqli_query($koneksi, "SELECT id_anggota, nama_lengkap FROM tabel_anggota WHERE status = 'aktif' ORDER BY nama_lengkap ASC");
            while ($anggota = mysqli_fetch_assoc($query_anggota)) {
                echo "<option value='{$anggota['id_anggota']}'>{$anggota['nama_lengkap']}</option>";
            }
            ?>
        </select>

        <label>Pilih Buku :</label>
        <select name="id_buku" required>
            <option value="">-- Pilih Buku --</option>
            <?php
            $query_buku = mysqli_query($koneksi, "SELECT id_buku, judul, stok FROM tabel_buku WHERE stok > 0 ORDER BY judul ASC");
            while ($buku = mysqli_fetch_assoc($query_buku)) {
                echo "<option value='{$buku['id_buku']}'>{$buku['judul']} (Stok: {$buku['stok']})</option>";
            }
            ?>
        </select>

        <label>Tanggal Pinjam :</label>
        <input type="date" name="tgl_pinjam" value="<?= $default_tgl_pinjam ?>" required>

        <label>Batas Tanggal Kembali :</label>
        <input type="date" name="tgl_kembali" value="<?= $default_tgl_kembali ?>" required>

        <button type="submit" name="simpan">Simpan</button>
        <a href="index.php">Batal</a>
    </form>
</div>
</body>
</html>
