<?php
require '../../../database/db.php';

$id = $_GET['id_suplai'];
$bahan = $_GET['id_bahan'];
$jumlah = $_GET['jumlah'];

$query = mysqli_query($koneksi, "UPDATE bahan SET stok=stok-'$jumlah' WHERE id_bahan='$bahan'");
if ($query) {
    $hapus = mysqli_query($koneksi, "DELETE FROM supplay_bahan WHERE id_supplay='$id'");
    if ($hapus) {
?>

        <script>
            document.location = '../../?page=suplaybahan&msg=Berhasil menghapus data suplai bahan';
        </script>
<?php
    }
}
?>