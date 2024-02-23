<?php
require '../../../database/db.php';

$nama       = $_POST['nama'];
$harga      = $_POST['harga'];
$stok     = 0;



$cek_produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE nama_produk='$nama'");

if (mysqli_num_rows($cek_produk) > 0) {
?>
    <script>
        window.location = '../../index.php?page=produk&msg=Gagal menambahkan data produk karena sudah ada';
    </script>


<?php
} else {

    $query = mysqli_query($koneksi, "INSERT INTO produk
        (nama_produk,stok,harga)
         VALUES 
         ('$nama','$stok','$harga')");


    echo "
<script>
window.location='../../index.php?page=produk&msg=Berhasil menambahkan data produk';
</script>
";
}

?>