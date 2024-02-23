<div class="container-fluid p-1">
    <a href="./content/function/ddprodukretur.php" class="btn btn-success"><i class="fas fa-fw fa-file-pdf"></i>Download PDF</a>
    <button type="button" class="btn btn-success mb-2" data-toggle="modal" style="float:right;" data-target="#tambahdataprodukretur" data-whatever="produkretur">Tambah Data Produk Retur</button>
</div>

<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover " id="data-table">
        <thead style="background-color: #1cc88a;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Nama Pegawai</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Tanggal Retur</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT produk_retur.*,produk.nama_produk,pegawai.nama from produk_retur INNER JOIN produk ON produk.id_produk = produk_retur.id_produk 
            INNER JOIN pegawai ON pegawai.id_pegawai = produk_retur.id_pegawai";

            $data = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td class="text-capitalize"><?php echo $d['nama_produk']; ?></td>
                    <td class="text-capitalize"><?php echo $d['nama']; ?></td>
                    <td><?php echo $d['jumlah']; ?></td>
                    <td><?php echo date_format(date_create($d['tanggal_retur']), "d-m-Y"); ?></td>
                    <td>
                        <a href="./content/function/hapusprodukretur.php?id_produkretur=<?php echo $d['id_produkretur'] ?>&id_produk=<?php echo $d['id_produk'] ?>&jumlah=<?php echo $d['jumlah'] ?>" class="link"><img name="delete" src="../assets/delete.png" onclick="return confirm('Yakin Akan di Hapus ?')"></a>
                    </td>
                </tr>

            <?php
            }
            ?>
        </tbody>
    </table>

</div>