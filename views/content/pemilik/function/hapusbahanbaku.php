<?php
require '../../../database/db.php';

$id = $_GET['id_bahanbaku'];
$idp = $_GET['id_produksi'];
$bahan = $_GET['id_bahan'];
$jumlah = $_GET['jumlah'];

$query = mysqli_query($koneksi, "UPDATE bahan SET stok=stok+'$jumlah' WHERE id_bahan='$bahan'");
if ($query) {
    $hapus = mysqli_query($koneksi, "DELETE FROM bahan_baku WHERE id_bahanbaku='$id'");
    if ($hapus) {
?>

        <script>
            document.location = '../../?page=bahanbaku&id_produksi=<?= $idp ?>&msg=Berhasil menghapus data bahan baku';
        </script>
<?php
    }
}
?>