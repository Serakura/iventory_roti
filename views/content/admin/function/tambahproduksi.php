<?php
require '../../../database/db.php';
date_default_timezone_set("Asia/Jakarta");
$produk  = $_POST['produk'];
$jumlah    = $_POST['jumlah'];
$tanggal  = date("Y/m/d");



$query = mysqli_query($koneksi, "INSERT INTO produksi
        (id_produk,jumlah_produksi,tanggal_produksi)
         VALUES 
         ('$produk','$jumlah','$tanggal')");

if ($query) {
    echo "
<script>
window.location='../../index.php?page=produksi&msg=Berhasil menambahkan data produksi';
</script>
";
} else {
    echo "
<script>
window.location='../../index.php?page=produksi&msg=Gagal menambahkan data produksi';
</script>
";
}
