<?php
require '../../../database/db.php';

$id  = $_POST['id_produksi'];
$bahan     = $_POST['bahan'];
$jumlah    = $_POST['jumlah'];




$query = mysqli_query($koneksi, "INSERT INTO bahan_baku
        (id_produksi,id_bahan,jumlah_bahanbaku)
         VALUES 
         ('$id','$bahan','$jumlah')");

if ($query) {
    echo "
<script>
window.location='../../index.php?page=bahanbaku&id_produksi=$id&msg=Berhasil menambahkan data bahan baku';
</script>
";
} else {
    echo "
<script>
window.location='../../index.php?page=bahanbaku&id_produksi=$id&msg=Gagal menambahkan data bahan baku';
</script>
";
}
