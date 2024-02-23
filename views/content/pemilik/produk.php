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
                <!-- Update Data Guru -->
                <div class="modal fade" id="updatedataproduk<?php echo $d['id_produk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Update Data Produk</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            $id = $d['id_produk'];
                            $query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id'");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <div class="modal-body">
                                    <form action="./content/function/updateproduk.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="nama" class="col-form-label">Nama Produk:</label>
                                            <input type="text" class="form-control" id="id_produk" name="id_produk" value="<?php echo $row['id_produk']; ?>" hidden>
                                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $row['nama_produk']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telepon" class="col-form-label">Harga:</label>
                                            <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>
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