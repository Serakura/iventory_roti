<div class="container-fluid p-1">
    <button type="button" class="btn btn-success mb-2" data-toggle="modal" style="float:right;" data-target="#tambahdatasuplai" data-whatever="suplai">Tambah Data Suplai Bahan</button>
</div>

<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover " id="data-table">
        <thead style="background-color: #1cc88a;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">Nama Supplier</th>
                <th scope="col">Nama Bahan</th>
                <th scope="col">Jumlah (Kg)</th>
                <th scope="col">Harga</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT supplay_bahan.*,supplier.nama_supplier,bahan.nama_bahan from supplay_bahan INNER JOIN bahan ON bahan.id_bahan = supplay_bahan.id_bahan 
            INNER JOIN supplier ON supplier.id_supplier = supplay_bahan.id_supplier";

            $data_supplay = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data_supplay)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td class="text-capitalize"><?php echo $d['nama_supplier']; ?></td>
                    <td class="text-capitalize"><?php echo $d['nama_bahan']; ?></td>
                    <td><?php echo $d['jumlah']; ?></td>
                    <td class="text-capitalize"><?php echo rupiah($d['harga']); ?></td>
                    <td><?php echo date_format(date_create($d['tanggal']), "d-m-Y"); ?></td>
                    <td>
                        <a href="./content/function/hapussuplai.php?id_suplai=<?php echo $d['id_supplay'] ?>&id_bahan=<?php echo $d['id_bahan'] ?>&jumlah=<?php echo $d['jumlah'] ?>" class="link"><img name="delete" src="../assets/delete.png" onclick="return confirm('Yakin Akan di Hapus ?')"></a>
                    </td>
                </tr>

            <?php
            }
            ?>
        </tbody>
    </table>

</div>