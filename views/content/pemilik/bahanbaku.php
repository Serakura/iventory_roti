<h4><?php echo $prd; ?> (<?php echo date_format(date_create($tgl), "d-m-Y"); ?>)</h4>


<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover " id="data-table">
        <thead style="background-color: #1cc88a;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">Nama Bahan</th>
                <th scope="col">Jumlah (Kg)</th>

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

                </tr>

            <?php
            }
            ?>
        </tbody>
    </table>

</div>