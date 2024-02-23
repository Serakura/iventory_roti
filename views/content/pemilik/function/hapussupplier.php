<?php
require '../../../database/db.php';

$id = $_GET['id_supplier'];

$hapus = mysqli_query($koneksi, "DELETE FROM supplier WHERE id_supplier='$id'");
if ($hapus) {
?>

    <script>
        document.location = '../../?page=supplier&msg=Berhasil menghapus data supplier';
    </script>
<?php
}

?>