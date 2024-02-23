<?php
require '../../../database/db.php';

$id = $_GET['id_produkretur'];
$produk = $_GET['id_produk'];
$jumlah = $_GET['jumlah'];


$hapus = mysqli_query($koneksi, "DELETE FROM produk_retur WHERE id_produkretur='$id'");
if ($hapus) {
?>

    <script>
        document.location = '../../?page=produkretur&msg=Berhasil menghapus data produk retur';
    </script>
<?php
}
?>