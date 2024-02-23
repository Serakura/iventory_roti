<?php
require '../../../database/db.php';

$id = $_GET['id_pegawai'];

$hapus = mysqli_query($koneksi, "DELETE FROM pegawai WHERE id_pegawai='$id'");
if ($hapus) {
?>

    <script>
        document.location = '../../?page=pegawai&msg=Berhasil menghapus data pegawai';
    </script>
<?php
}

?>