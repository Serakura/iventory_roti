<?php
require '../../../database/db.php';
$id = $_POST['id_produk'];
$nama       = $_POST['nama_produk'];
$harga       = $_POST['harga'];

$query = mysqli_query($koneksi, "UPDATE produk SET nama_produk='$nama',  harga='$harga' WHERE id_produk='$id'");
if ($query) {
    echo "<script>
window.location='../../index.php?page=produk&msg=Berhasil mengupdate data produk';</script>";
} else {
    echo "<script>
    window.location='../../index.php?page=produk&msg=Gagal mengupdate data produk';</script>";
}
