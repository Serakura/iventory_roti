<?php
require '../../../database/db.php';

$id = $_GET['id_bahan'];

$hapus = mysqli_query($koneksi, "DELETE FROM bahan WHERE id_bahan='$id'");
if ($hapus) {
?>

    <script>
        document.location = '../../?page=bahan&msg=Berhasil menghapus data bahan';
    </script>
<?php
}

?>