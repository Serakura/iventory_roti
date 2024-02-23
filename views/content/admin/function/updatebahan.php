<?php
require '../../../database/db.php';
$id = $_POST['id_bahan'];
$nama       = $_POST['nama_bahan'];

$query = mysqli_query($koneksi, "UPDATE bahan SET nama_bahan='$nama' WHERE id_bahan='$id'");
if ($query) {
    echo "<script>
window.location='../../index.php?page=bahan&msg=Berhasil mengupdate data bahan';</script>";
} else {
    echo "<script>
    window.location='../../index.php?page=bahan&msg=Gagal mengupdate data bahan';</script>";
}
