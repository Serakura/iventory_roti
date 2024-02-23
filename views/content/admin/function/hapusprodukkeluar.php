<?php
require '../../../database/db.php';

$id = $_GET['id_produkkeluar'];
$produk = $_GET['id_produk'];
$jumlah = $_GET['jumlah'];

$query = mysqli_query($koneksi, "UPDATE produk SET stok=stok+'$jumlah' WHERE id_produk='$produk'");
if ($query) {
    $hapus = mysqli_query($koneksi, "DELETE FROM produk_keluar WHERE id_produkkeluar='$id'");
    if ($hapus) {
?>

        <script>
            document.location = '../../?page=produkkeluar&msg=Berhasil menghapus data produk keluar';
        </script>
<?php
    }
}
?>