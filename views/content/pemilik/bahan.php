<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover " id="data-table">
        <thead style="background-color: #1cc88a;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">Nama Bahan</th>
                <th scope="col">Stok (Kg)</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * from bahan";

            $data_bahan = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data_bahan)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td class="text-capitalize"><?php echo $d['nama_bahan']; ?></td>
                    <td><?php if ($d['stok'] < 0.01) {
                            echo '0';
                        } else {
                            echo $d['stok'];
                        } ?></td>

                </tr>
                <!-- Update Data Guru -->
                <div class="modal fade" id="updatedatabahan<?php echo $d['id_bahan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Update Data Bahan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            $id = $d['id_bahan'];
                            $query = mysqli_query($koneksi, "SELECT * FROM bahan WHERE id_bahan='$id'");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <div class="modal-body">
                                    <form action="./content/function/updatebahan.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="nama" class="col-form-label">Nama Bahan:</label>
                                            <input type="text" class="form-control" id="id_bahan" name="id_bahan" value="<?php echo $row['id_bahan']; ?>" hidden>
                                            <input type="text" class="form-control" id="nama_bahan" name="nama_bahan" value="<?php echo $row['nama_bahan']; ?>" required>
                                        </div>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                                    </form>
                                <?php
                            }
                                ?>
                                </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </tbody>
    </table>

</div>