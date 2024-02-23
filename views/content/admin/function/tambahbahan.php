<?php
require '../../../database/db.php';

$nama       = $_POST['nama'];
$stok     = 0;



$cek_produk = mysqli_query($koneksi, "SELECT * FROM bahan WHERE nama_bahan='$nama'");

if (mysqli_num_rows($cek_produk) > 0) {
?>
    <script>
        window.location = '../../index.php?page=bahan&msg=Gagal menambahkan data bahan karena sudah ada';
    </script>


<?php
} else {

    $query = mysqli_query($koneksi, "INSERT INTO bahan
        (nama_bahan,stok)
         VALUES 
         ('$nama','$stok')");


    echo "
<script>
window.location='../../index.php?page=bahan&msg=Berhasil menambahkan data bahan';
</script>
";
}

?>