<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover " id="data-table">
        <thead style="background-color: #1cc88a;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">Nama Supplier</th>
                <th scope="col">No.Telp</th>
                <th scope="col">Alamat</th>


            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * from supplier";

            $data_supplier = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data_supplier)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td class="text-capitalize"><?php echo $d['nama_supplier']; ?></td>
                    <td><?php echo $d['no_telp']; ?></td>
                    <td class="text-capitalize"><?php echo $d['alamat']; ?></td>

                </tr>
                <!-- Update Data Guru -->
                <div class="modal fade" id="updatedatasupplier<?php echo $d['id_supplier'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Update Data Supplier</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            $id = $d['id_supplier'];
                            $query = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id_supplier='$id'");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <div class="modal-body">
                                    <form action="./content/function/updatesupplier.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="nama" class="col-form-label">Nama Supplier:</label>
                                            <input type="text" class="form-control" id="id_supplier" name="id_supplier" value="<?php echo $row['id_supplier']; ?>" hidden>
                                            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="<?php echo $row['nama_supplier']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telepon" class="col-form-label">Telepon:</label>
                                            <input type="number" class="form-control" id="telepon" name="telepon" value="<?php echo $row['no_telp']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat" class="col-form-label">Alamat:</label>
                                            <textarea class="form-control" id="alamat" name="alamat" required><?php echo $row['alamat']; ?></textarea>
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