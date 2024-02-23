<div class="container-fluid p-1">
    <a href="./content/function/ddprodukkeluar.php" class="btn btn-success"><i class="fas fa-fw fa-file-pdf"></i>Download PDF</a>
    <button type="button" class="btn btn-success mb-2" data-toggle="modal" style="float:right;" data-target="#tambahdataprodukkeluar" data-whatever="produkkeluar">Tambah Data Produk Keluar</button>
</div>

<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover " id="data-table">
        <thead style="background-color: #1cc88a;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Nama Pegawai</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Tanggal Keluar</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT produk_keluar.*,produk.nama_produk,pegawai.nama from produk_keluar INNER JOIN produk ON produk.id_produk = produk_keluar.id_produk 
            INNER JOIN pegawai ON pegawai.id_pegawai = produk_keluar.id_pegawai";

            $data = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td class="text-capitalize"><?php echo $d['nama_produk']; ?></td>
                    <td class="text-capitalize"><?php echo $d['nama']; ?></td>
                    <td><?php echo $d['jumlah']; ?></td>
                    <td><?php echo date_format(date_create($d['tanggal_keluar']), "d-m-Y"); ?></td>
                    <td>
                        <a href="./content/function/hapusprodukkeluar.php?id_produkkeluar=<?php echo $d['id_produkkeluar'] ?>&id_produk=<?php echo $d['id_produk'] ?>&jumlah=<?php echo $d['jumlah'] ?>" class="link"><img name="delete" src="../assets/delete.png" onclick="return confirm('Yakin Akan di Hapus ?')"></a>
                    </td>
                </tr>

            <?php
            }
            ?>
        </tbody>
    </table>

</div>