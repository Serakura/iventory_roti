<?php
require '../../../database/db.php';

$id = $_GET['id_produksi'];
$produk = $_GET['id_produk'];
$jumlah = $_GET['jumlah'];

$query = mysqli_query($koneksi, "UPDATE produk SET stok=stok-'$jumlah' WHERE id_produk='$produk'");
if ($query) {
    $hapus = mysqli_query($koneksi, "DELETE FROM produksi WHERE id_produksi='$id'");
    if ($hapus) {
?>

        <script>
            document.location = '../../?page=produksi&msg=Berhasil menghapus data produksi';
        </script>
<?php
    }
}
?>