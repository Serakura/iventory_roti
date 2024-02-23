<?php
require '../database/db.php';
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $query = mysqli_query($koneksi, "SELECT * FROM user_admin WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($query) == 0) {
?>
        <script>
            alert("Maaf akun tidak ditemukan!");
            document.location = "./../index.php";
        </script>
    <?php
    } else {
        $result = mysqli_fetch_assoc($query);

        $_SESSION['id_user'] = $result['id_user'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['password'] = $result['password'];
        $_SESSION['nama'] = $result['nama'];
        $_SESSION['role']   = $result['role'];

    ?>

        <script>
            alert("Selamat Datang <?php echo $_SESSION['nama']; ?> di Aplikasi Inventory Roti");
            document.location = "./../views/index.php";
        </script>

<?php
    }
}
?>