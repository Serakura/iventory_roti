<?php
require '../../../database/db.php';

$id = $_GET['id_produk'];

$hapus = mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk='$id'");
if ($hapus) {
?>

    <script>
        document.location = '../../?page=produk&msg=Berhasil menghapus data produk';
    </script>
<?php
}

?>