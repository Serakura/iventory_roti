<?php
require '../../../database/db.php';
date_default_timezone_set("Asia/Jakarta");
$supplier  = $_POST['supplier'];
$bahan     = $_POST['bahan'];
$jumlah    = $_POST['jumlah'];
$harga      = $_POST['harga'];
$tanggal  = date("Y/m/d");



$query = mysqli_query($koneksi, "INSERT INTO supplay_bahan
        (id_supplier,id_bahan,jumlah,harga,tanggal)
         VALUES 
         ('$supplier','$bahan','$jumlah','$harga','$tanggal')");

if ($query) {
    echo "
<script>
window.location='../../index.php?page=suplaybahan&msg=Berhasil menambahkan data suplai bahan';
</script>
";
} else {
    echo "
<script>
window.location='../../index.php?page=suplaybahan&msg=Gagal menambahkan data suplai bahan';
</script>
";
}
