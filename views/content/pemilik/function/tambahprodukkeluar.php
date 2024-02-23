<?php
require '../../../database/db.php';
date_default_timezone_set("Asia/Jakarta");
$produk  = $_POST['produk'];
$pegawai     = $_POST['pegawai'];
$jumlah    = $_POST['jumlah'];
$tanggal  = $_POST['tanggal'];



$query = mysqli_query($koneksi, "INSERT INTO produk_keluar
        (id_produk,id_pegawai,jumlah,tanggal_keluar)
         VALUES 
         ('$produk','$pegawai','$jumlah','$tanggal')");

if ($query) {
    echo "
<script>
window.location='../../index.php?page=produkkeluar&msg=Berhasil menambahkan data produk keluar';
</script>
";
} else {
    echo "
<script>
window.location='../../index.php?page=produkkeluar&msg=Gagal menambahkan data produk keluar';
</script>
";
}
