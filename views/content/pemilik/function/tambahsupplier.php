<?php
require '../../../database/db.php';

$nama       = $_POST['nama'];
$telp       = $_POST['telepon'];
$alamat     = $_POST['alamat'];



$cek_supplier = mysqli_query($koneksi, "SELECT * FROM supplier WHERE nama_supplier='$nama'");

if (mysqli_num_rows($cek_supplier) > 0) {
?>
    <script>
        window.location = '../../index.php?page=supplier&msg=Gagal menambahkan data supplier karena sudah ada';
    </script>


<?php
} else {

    $query = mysqli_query($koneksi, "INSERT INTO supplier
        (nama_supplier,no_telp,alamat)
         VALUES 
         ('$nama','$telp','$alamat')");


    echo "
<script>
window.location='../../index.php?page=supplier&msg=Berhasil menambahkan data supplier';
</script>
";
}

?>