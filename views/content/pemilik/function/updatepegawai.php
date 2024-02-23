<?php
require '../../../database/db.php';
$id = $_POST['id_pegawai'];
$nama       = $_POST['nama'];
$tanggal    = $_POST['tanggal_lahir'];
$jenkel     = $_POST['jeniskelamin'];
$telp       = $_POST['telepon'];
$alamat     = $_POST['alamat_asal'];
$alamat1     = $_POST['alamat_sekarang'];
$kerja   = $_POST['kerja'];


$query = mysqli_query($koneksi, "UPDATE pegawai SET nama='$nama', tgl_lahir='$tanggal', jenis_kelamin='$jenkel', no_telp='$telp', alamat_asal='$alamat', alamat_sekarang='$alamat1', bidang_pekerjaan='$kerja' WHERE id_pegawai='$id'");
if ($query) {
    echo "<script>
window.location='../../index.php?page=pegawai&msg=Berhasil mengupdate data pegawai';</script>";
} else {
    echo "<script>
    window.location='../../index.php?page=pegawai&msg=Gagal mengupdate data pegawai';</script>";
}
