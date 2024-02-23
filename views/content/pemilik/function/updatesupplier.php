<?php
require '../../../database/db.php';
$id = $_POST['id_supplier'];
$nama       = $_POST['nama_supplier'];
$telp       = $_POST['telepon'];
$alamat     = $_POST['alamat'];

$query = mysqli_query($koneksi, "UPDATE supplier SET nama_supplier='$nama',  no_telp='$telp', alamat='$alamat' WHERE id_supplier='$id'");
if ($query) {
    echo "<script>
window.location='../../index.php?page=supplier&msg=Berhasil mengupdate data supplier';</script>";
} else {
    echo "<script>
    window.location='../../index.php?page=supplier&msg=Gagal mengupdate data supplier';</script>";
}
