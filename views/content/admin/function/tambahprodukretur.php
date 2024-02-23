<?php
require '../../../database/db.php';
date_default_timezone_set("Asia/Jakarta");
$produk  = $_POST['produk'];
$pegawai     = $_POST['pegawai'];
$jumlah    = $_POST['jumlah'];
$tanggal  = $_POST['tanggal'];



$query = mysqli_query($koneksi, "INSERT INTO produk_retur
        (id_produk,id_pegawai,jumlah,tanggal_retur)
         VALUES 
         ('$produk','$pegawai','$jumlah','$tanggal')");

if ($query) {
    echo "
<script>
window.location='../../index.php?page=produkretur&msg=Berhasil menambahkan data produk retur';
</script>
";
} else {
    echo "
<script>
window.location='../../index.php?page=produkretur&msg=Gagal menambahkan data produk retur';
</script>
";
}
