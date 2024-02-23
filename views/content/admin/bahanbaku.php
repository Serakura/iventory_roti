<h4><?php echo $prd; ?> (<?php echo date_format(date_create($tgl), "d-m-Y"); ?>)</h4>
<div class="container-fluid p-1">
    <button type="button" class="btn btn-success mb-2" data-toggle="modal" style="float:right;" data-target="#tambahdatabahanbaku" data-whatever="bahanbaku">Tambah Data Bahan Baku</button>
</div>

<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover " id="data-table">
        <thead style="background-color: #1cc88a;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">Nama Bahan</th>
                <th scope="col">Jumlah (Kg)</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT bahan_baku.*,bahan.nama_bahan from bahan_baku INNER JOIN bahan ON bahan.id_bahan = bahan_baku.id_bahan";

            $data_bahanbaku = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data_bahanbaku)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td class="text-capitalize"><?php echo $d['nama_bahan']; ?></td>
                    <td><?php echo $d['jumlah_bahanbaku']; ?></td>
                    <td>
                        <a href="./content/function/hapusbahanbaku.php?id_bahanbaku=<?php echo $d['id_bahanbaku'] ?>&id_produksi=<?php echo $d['id_produksi'] ?>&id_bahan=<?php echo $d['id_bahan'] ?>&jumlah=<?php echo $d['jumlah_bahanbaku'] ?>" class="link"><img name="delete" src="../assets/delete.png" onclick="return confirm('Yakin Akan di Hapus ?')"></a>
                    </td>
                </tr>

            <?php
            }
            ?>
        </tbody>
    </table>

</div>