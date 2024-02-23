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