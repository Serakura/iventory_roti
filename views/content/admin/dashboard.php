<?php
require '../database/db.php';

$pegawai = mysqli_query($koneksi, "SELECT id_pegawai FROM pegawai");
$produk  = mysqli_query($koneksi, "SELECT id_produk FROM produk");
$bahan = mysqli_query($koneksi, "SELECT id_bahan FROM bahan");
$supplier = mysqli_query($koneksi, "SELECT id_supplier FROM supplier");
?>
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <h6>Jumlah Pegawai</h6>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                                            if ($pegawai) {
                                                                                $sis = mysqli_num_rows($pegawai);
                                                                                if ($sis) {
                                                                                    echo $sis;
                                                                                }
                                                                            } else {
                                                                                echo 'gagal';
                                                                            }
                                                                            ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            <h6>Jumlah Produk</h6>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                                            if ($produk) {
                                                                                $sis = mysqli_num_rows($produk);
                                                                                if ($sis) {
                                                                                    echo $sis;
                                                                                }
                                                                            } else {
                                                                                echo 'gagal';
                                                                            }
                                                                            ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            <h6>Jumlah Bahan</h6>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                                            if ($bahan) {
                                                                                $sis = mysqli_num_rows($bahan);
                                                                                if ($sis) {
                                                                                    echo $sis;
                                                                                }
                                                                            } else {
                                                                                echo 'gagal';
                                                                            }
                                                                            ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-home fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            <h6>Jumlah Suplier</h6>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                                            if ($supplier) {
                                                                                $sis = mysqli_num_rows($supplier);
                                                                                if ($sis) {
                                                                                    echo $sis;
                                                                                }
                                                                            } else {
                                                                                echo 'gagal';
                                                                            }
                                                                            ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-7 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Produksi</h5>

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive border px-2 py-4">
                    <table class="table table-bordered table-hover " id="data-table">
                        <thead style="background-color: #1cc88a;">
                            <tr class="text-light">
                                <th scope="col">No</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Bahan Baku</th>
                                <th scope="col">Jumlah Produksi</th>
                                <th scope="col">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT produksi.*,produk.nama_produk from produksi INNER JOIN produk ON produk.id_produk = produksi.id_produk";

                            $data_produksi = mysqli_query($koneksi, $query);
                            $nomor = 1;
                            while ($d = mysqli_fetch_array($data_produksi)) {
                            ?>
                                <tr>
                                    <td><?php echo $nomor++; ?></td>
                                    <td class="text-capitalize"><?php echo $d['nama_produk']; ?></td>
                                    <td class="text-capitalize"><a class="btn btn-warning" href="index.php?page=bahanbaku&id_produksi=<?php echo $d['id_produksi'] ?>">Bahan Baku</a></td>
                                    <td><?php echo $d['jumlah_produksi']; ?></td>
                                    <td><?php echo date_format(date_create($d['tanggal_produksi']), "d-m-Y"); ?></td>

                                </tr>

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-5 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">List Produk</h5>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="container text-center ">
                    <div class="table-responsive border px-2 py-4">
                        <table class="table table-bordered table-hover " id="data-table">
                            <thead style="background-color: #1cc88a;">
                                <tr class="text-light">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Harga</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from produk";

                                $data_produk = mysqli_query($koneksi, $query);
                                $nomor = 1;
                                while ($d = mysqli_fetch_array($data_produk)) {
                                ?>
                                    <tr>
                                        <td><?php echo $nomor++; ?></td>
                                        <td class="text-capitalize"><?php echo $d['nama_produk']; ?></td>
                                        <td><?php echo $d['stok']; ?></td>
                                        <td class="text-capitalize"><?php echo rupiah($d['harga']); ?></td>

                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>