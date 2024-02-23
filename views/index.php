<?php
session_start();
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
require '../database/db.php';
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
}

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = "dashboard";
}

?>
<!DOCTYPE html>
<html lang="en" manifest="../assets//manifest/app.manifest">

<head>
    <?php
    include 'layouts/head.php';
    ?>

<body id="page-top">
    <?php if (isset($_GET['msg'])) { ?>
        <div aria-live="polite" aria-atomic="true" class="position-relative" data-autohide="false">
            <!-- Position it: -->
            <!-- - `.toast-container` for spacing between toasts -->
            <!-- - `.position-absolute`, `top-0` & `end-0` to position the toasts in the upper right corner -->
            <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
            <div class="toast-container position-absolute top-0 end-0 p-3" style="z-index: 10;">

                <!-- Then put toasts within -->
                <div id="toast-delayer" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" data-bs-delay="5000">
                    <div class="toast-header">
                        <strong class="me-auto">Bootstrap</strong>
                        <small class="text-muted">just now</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <?= ($_GET['msg']); ?>
                    </div>
                </div>

            </div>
        </div>
    <?php } ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'layouts/sidebar.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'layouts/navbar.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h2 mb-0 text-dark text-capitalize font-weight-bold"><?php
                                                                                        if ($page == 'suplaybahan') {
                                                                                            echo 'Suplai Bahan';
                                                                                        } else if ($page == 'bahanbaku') {
                                                                                            echo 'Bahan Baku';
                                                                                            $idp = $_GET['id_produksi'];
                                                                                            $tgl = "";
                                                                                            $prd = "";
                                                                                            $q = mysqli_query($koneksi, "SELECT produk.nama_produk,produksi.tanggal_produksi FROM produksi INNER JOIN produk ON produk.id_produk = produksi.id_produk WHERE id_produksi='$idp'");
                                                                                            while ($rw = mysqli_fetch_row($q)) {
                                                                                                $prd = $rw[0];
                                                                                                $tgl = $rw[1];
                                                                                            }
                                                                                        } else if ($page == 'produkkeluar') {
                                                                                            echo 'Produk Keluar';
                                                                                        } else if ($page == 'produkretur') {
                                                                                            echo 'Produk Retur';
                                                                                        } else {
                                                                                            echo $page;
                                                                                        }


                                                                                        ?></h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- konten ditampilkan disini -->
                    <?php
                    include "content/" . $_SESSION['role'] . "/" . $page . ".php";
                    ?>
                    <!-- ini batas penutup konten -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Arief</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin mau keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tekan tombol "Logout" untuk keluar dari akunmu</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../function/funct_logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Data Pegawai -->
    <div class="modal fade" id="tambahdatapegawai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/function/tambahpegawai.php" method="POST">
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir" class="col-form-label">Tanggal Lahir:</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="jeniskelamin" class="col-form-label">Jenis Kelamin:</label>
                            <select id="jeniskelamin" class="form-control" name="jeniskelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="telepon" class="col-form-label">Telepon:</label>
                            <input type="number" class="form-control" id="telepon" name="telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-form-label">Alamat Asal:</label>
                            <textarea class="form-control" id="alamat_asal" name="alamat_asal" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-form-label">Alamat Sekarang:</label>
                            <textarea class="form-control" id="alamat_sekarang" name="alamat_sekarang" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="kerja" class="col-form-label">Bidang Pekerjaan:</label>
                            <select id="kerja" class="form-control" name="kerja" required>
                                <option value="">Pilih Bidang Pekerjaan</option>
                                <option value="Produksi">Produksi</option>
                                <option value="Pemasaran">Pemasaran</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Data Supplier -->
    <div class="modal fade" id="tambahdatasupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/function/tambahsupplier.php" method="POST">
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama Supplier:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="telepon" class="col-form-label">Telepon:</label>
                            <input type="number" class="form-control" id="telepon" name="telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-form-label">Alamat:</label>
                            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Data Produk -->
    <div class="modal fade" id="tambahdataproduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/function/tambahproduk.php" method="POST">
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama Produk:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="telepon" class="col-form-label">Harga:</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Data Bahan -->
    <div class="modal fade" id="tambahdatabahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Bahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/function/tambahbahan.php" method="POST">
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama Bahan:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Data Suplai Bahan -->
    <div class="modal fade" id="tambahdatasuplai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Suplai Bahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/function/tambahsuplai.php" method="POST">
                        <div class="form-group">
                            <label for="kelas" class="col-form-label">Supplier:</label>
                            <select id="kelas" class="form-control" name="supplier" required>
                                <option value="" selected>Pilih Supplier</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM supplier");
                                while ($wi = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $wi['id_supplier'] ?> "><?php echo $wi['nama_supplier'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelas" class="col-form-label">Bahan:</label>
                            <select id="kelas" class="form-control" name="bahan" required>
                                <option value="" selected>Pilih Bahan</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM bahan");
                                while ($wi = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $wi['id_bahan'] ?> "><?php echo $wi['nama_bahan'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah" class="col-form-label">Jumlah:</label>
                            <input type="float" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                        <div class="form-group">
                            <label for="harga" class="col-form-label">Harga:</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Data Produksi -->
    <div class="modal fade" id="tambahdataproduksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Produksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/function/tambahproduksi.php" method="POST">
                        <div class="form-group">
                            <label for="kelas" class="col-form-label">Produk:</label>
                            <select id="kelas" class="form-control" name="produk" required>
                                <option value="" selected>Pilih Produk</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM produk");
                                while ($wi = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $wi['id_produk'] ?> "><?php echo $wi['nama_produk'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah" class="col-form-label">Jumlah:</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Data Bahan Baku -->
    <div class="modal fade" id="tambahdatabahanbaku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Bahan Baku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/function/tambahbahanbaku.php" method="POST">
                        <div class="form-group">
                            <label for="kelas" class="col-form-label">Bahan:</label>
                            <select id="kelas" class="form-control" name="bahan" required>
                                <option value="" selected>Pilih Bahan</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM bahan");
                                while ($wi = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $wi['id_bahan'] ?> "><?php echo $wi['nama_bahan'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah" class="col-form-label">Jumlah:</label>
                            <input type="float" class="form-control" id="jumlah" name="jumlah" required>
                            <input type="text" class="form-control" id="id_produksi" name="id_produksi" value="<?php echo $idp ?>" hidden>
                        </div>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Data Produk Keluar -->
    <div class="modal fade" id="tambahdataprodukkeluar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Produk Keluar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/function/tambahprodukkeluar.php" method="POST">
                        <div class="form-group">
                            <label for="kelas" class="col-form-label">Produk:</label>
                            <select id="kelas" class="form-control" name="produk" required>
                                <option value="" selected>Pilih Produk</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM produk");
                                while ($wi = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $wi['id_produk'] ?> "><?php echo $wi['nama_produk'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelas" class="col-form-label">Pegawai:</label>
                            <select id="kelas" class="form-control" name="pegawai" required>
                                <option value="" selected>Pilih Pegawai</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM pegawai");
                                while ($wi = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $wi['id_pegawai'] ?> "><?php echo $wi['nama'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah" class="col-form-label">Jumlah:</label>
                            <input type="float" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal" class="col-form-label">Tanggal:</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Data Produk Retur -->
    <div class="modal fade" id="tambahdataprodukretur" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Produk Retur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/function/tambahprodukretur.php" method="POST">
                        <div class="form-group">
                            <label for="kelas" class="col-form-label">Produk:</label>
                            <select id="kelas" class="form-control" name="produk" required>
                                <option value="" selected>Pilih Produk</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM produk");
                                while ($wi = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $wi['id_produk'] ?> "><?php echo $wi['nama_produk'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelas" class="col-form-label">Pegawai:</label>
                            <select id="kelas" class="form-control" name="pegawai" required>
                                <option value="" selected>Pilih Pegawai</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM pegawai");
                                while ($wi = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $wi['id_pegawai'] ?> "><?php echo $wi['nama'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah" class="col-form-label">Jumlah:</label>
                            <input type="float" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal" class="col-form-label">Tanggal:</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Data Kelas -->
    <div class="modal fade" id="tambahdatakelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/admin/function/tambahkelas.php" method="POST">
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Data Siswa -->
    <div class="modal fade" id="tambahdatasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/admin/function/tambahsiswa.php" method="POST">
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="nip" class="col-form-label">NIS:</label>
                            <input type="text" class="form-control" id="nis" name="nis" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="jeniskelamin" class="col-form-label">Jenis Kelamin:</label>
                            <select id="jeniskelamin" class="form-control" name="jeniskelamin" required>
                                <option value="" selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="telepon" class="col-form-label">Telepon:</label>
                            <input type="number" class="form-control" id="telepon" name="telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-form-label">Alamat:</label>
                            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="kelas" class="col-form-label">Kelas:</label>
                            <select id="kelas" class="form-control" name="kelas" required>
                                <option value="" selected>Pilih Kelas</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM kelas");
                                while ($wi = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $wi['id_kelas'] ?> "><?php echo $wi['nama_kelas'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambah Data Mata Pelajaran -->
    <div class="modal fade" id="tambahdatamapel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Pelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/admin/function/tambahmapel.php" method="POST">
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Kode Mata Pelajaran:</label>
                            <input type="text" class="form-control" id="kode" name="kode" required>
                        </div>
                        <div class="form-group">
                            <label for="nip" class="col-form-label">Nama Mata Pelajaran:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="kelas" class="col-form-label">Kelas:</label>
                            <select id="kelas" class="form-control" name="kelas" required>
                                <option value="" selected>Pilih Kelas</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM kelas");
                                while ($wi = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $wi['id_kelas'] ?> "><?php echo $wi['nama_kelas'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="guru" class="col-form-label">Guru Pengampu:</label>
                            <select id="guru" class="form-control" name="guru" required>
                                <option value="" selected>Pilih Guru Pengampu</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM guru");
                                while ($wi = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $wi['id_guru'] ?> "><?php echo $wi['nama'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include 'layouts/script.php' ?>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#data-table').DataTable({
                select: false,
                search: {
                    caseInsensitive: false,
                    regex: true
                }
            });
        });
    </script>
    <script>
        var editor = CKEDITOR.replace('editor1', {
            extraPlugins: 'embed,autoembed,image2',
            height: 500,

            // Load the default contents.css file plus customizations for this sample.
            contentsCss: [
                'http://cdn.ckeditor.com/4.18.0/full-all/contents.css',
                'https://ckeditor.com/docs/ckeditor4/4.18.0/examples/assets/css/widgetstyles.css'
            ],
            // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
            embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

            // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
            // resizer (because image size is controlled by widget styles or the image takes maximum
            // 100% of the editor width).
            image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
            // image2_disableResizer: true,
            removeButtons: 'PasteFromWord'
        });
        CKFinder.setupCKEditor(editor);
        var editor1 = CKEDITOR.replace('editor2', {
            extraPlugins: 'embed,autoembed,image2',
            height: 200,

            // Load the default contents.css file plus customizations for this sample.
            contentsCss: [
                'http://cdn.ckeditor.com/4.18.0/full-all/contents.css',
                'https://ckeditor.com/docs/ckeditor4/4.18.0/examples/assets/css/widgetstyles.css'
            ],
            // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
            embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

            // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
            // resizer (because image size is controlled by widget styles or the image takes maximum
            // 100% of the editor width).
            image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
            // image2_disableResizer: true,
            removeButtons: 'PasteFromWord'
        });
        CKFinder.setupCKEditor(editor1);
    </script>
    <script>
        $('.toast').toast('show');
    </script>

</body>

</html>