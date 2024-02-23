<?php
require '../../../database/db.php';

$nama       = $_POST['nama'];
$tanggal    = $_POST['tanggal_lahir'];
$jenkel     = $_POST['jeniskelamin'];
$telp       = $_POST['telepon'];
$alamat     = $_POST['alamat_asal'];
$alamat1     = $_POST['alamat_sekarang'];
$kerja   = $_POST['kerja'];


$cek_pegawai = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE nama='$nama'");

if (mysqli_num_rows($cek_pegawai) > 0) {
?>
    <script>
        window.location = '../../index.php?page=pegawai&msg=Gagal menambahkan data pegawai karena sudah ada';
    </script>


<?php
} else {

    $query = mysqli_query($koneksi, "INSERT INTO pegawai 
        (nama,tgl_lahir,jenis_kelamin,no_telp,alamat_asal,alamat_sekarang,bidang_pekerjaan)
         VALUES 
         ('$nama','$tanggal','$jenkel','$telp','$alamat','$alamat1','$kerja')");


    echo "
<script>
window.location='../../index.php?page=pegawai&msg=Berhasil menambahkan data pegawai';
</script>
";
}

?>