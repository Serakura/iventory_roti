   <div class="container-fluid p-1">
       <button type="button" class="btn btn-success mb-2" data-toggle="modal" style="float:right;" data-target="#tambahdatapegawai" data-whatever="pegawai">Tambah Data Pegawai</button>
   </div>

   <div class="table-responsive border px-2 py-4">
       <table class="table table-bordered table-hover " id="data-table">
           <thead style="background-color: #1cc88a;">
               <tr class="text-light">
                   <th scope="col">No</th>
                   <th scope="col">Nama</th>
                   <th scope="col">Tanggal Lahir</th>
                   <th scope="col">Jenis Kelamin</th>
                   <th scope="col">No.Telp</th>
                   <th scope="col">Alamat Asal</th>
                   <th scope="col">Alamat Sekarang</th>
                   <th scope="col">Bidang Kerja</th>
                   <th scope="col">Aksi</th>

               </tr>
           </thead>
           <tbody>
               <?php

                use function GuzzleHttp\Psr7\str;

                $query = "SELECT * from pegawai";

                $data_pegawai = mysqli_query($koneksi, $query);
                $nomor = 1;
                while ($d = mysqli_fetch_array($data_pegawai)) {
                ?>
                   <tr>
                       <td><?php echo $nomor++; ?></td>
                       <td class="text-capitalize"><?php echo $d['nama']; ?></td>
                       <td><?php echo date_format(date_create($d['tgl_lahir']), "d-m-Y"); ?></td>
                       <td><?php echo $d['jenis_kelamin']; ?></td>
                       <td><?php echo $d['no_telp']; ?></td>
                       <td class="text-capitalize"><?php echo $d['alamat_asal']; ?></td>
                       <td class="text-capitalize"><?php echo $d['alamat_sekarang']; ?></td>
                       <td><?php echo $d['bidang_pekerjaan']; ?></td>
                       <td>
                           <a data-toggle="modal" data-target="#updatedatapegawai<?php echo $d['id_pegawai']; ?>" class="link"><img name="pencil" src="../assets/edit.png"></a>
                           <a href="./content/function/hapuspegawai.php?id_pegawai=<?php echo $d['id_pegawai'] ?>" class="link"><img name="delete" src="../assets/delete.png" onclick="return confirm('Yakin Akan di Hapus ?')"></a>
                       </td>
                   </tr>
                   <!-- Update Data Guru -->
                   <div class="modal fade" id="updatedatapegawai<?php echo $d['id_pegawai'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h5 class="modal-title" id="exampleModalLabel">Update Data Pegawai</h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                   </button>
                               </div>
                               <?php
                                $id = $d['id_pegawai'];
                                $query = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_pegawai='$id'");
                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                   <div class="modal-body">
                                       <form action="./content/function/updatepegawai.php" method="POST" enctype="multipart/form-data">
                                           <div class="form-group">
                                               <label for="nama" class="col-form-label">Nama:</label>
                                               <input type="text" class="form-control" id="id_pegawai" name="id_pegawai" value="<?php echo $row['id_pegawai']; ?>" hidden>
                                               <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
                                           </div>
                                           <div class="form-group">
                                               <label for="tanggal_lahir" class="col-form-label">Tanggal Lahir:</label>
                                               <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $row['tgl_lahir'] ?>" required>
                                           </div>
                                           <div class="form-group">
                                               <label for="jeniskelamin" class="col-form-label">Jenis Kelamin:</label>
                                               <select id="jeniskelamin" class="form-control" name="jeniskelamin" value="<?php echo $row['jenis_kelamin']; ?>" required>
                                                   <option value="">Pilih Jenis Kelamin</option>
                                                   <option value="Laki-laki" <?php if ($row['jenis_kelamin'] == "Laki-laki") {
                                                                                    echo 'selected';
                                                                                } ?>>Laki-laki</option>
                                                   <option value="Perempuan" <?php if ($row['jenis_kelamin'] == "Perempuan") {
                                                                                    echo 'selected';
                                                                                } ?>>Perempuan</option>
                                               </select>
                                           </div>
                                           <div class="form-group">
                                               <label for="telepon" class="col-form-label">Telepon:</label>
                                               <input type="number" class="form-control" id="telepon" name="telepon" value="<?php echo $row['no_telp']; ?>" required>
                                           </div>
                                           <div class="form-group">
                                               <label for="alamat" class="col-form-label">Alamat Asal:</label>
                                               <textarea class="form-control" id="alamat_asal" name="alamat_asal" required><?php echo $row['alamat_asal']; ?></textarea>
                                           </div>
                                           <div class="form-group">
                                               <label for="alamat" class="col-form-label">Alamat Sekarang:</label>
                                               <textarea class="form-control" id="alamat_sekarang" name="alamat_sekarang" required><?php echo $row['alamat_sekarang']; ?></textarea>
                                           </div>
                                           <div class="form-group">
                                               <label for="kerja" class="col-form-label">Bidang Pekerjaan:</label>
                                               <select id="kerja" class="form-control" name="kerja" value="<?php echo $row['bidang_pekerjaan']; ?>" required>
                                                   <option value="">Pilih Bidang Pekerjaan</option>
                                                   <option value="Produksi" <?php if ($row['bidang_pekerjaan'] == "Produksi") {
                                                                                echo 'selected';
                                                                            } ?>>Produksi</option>
                                                   <option value="Pemasaran" <?php if ($row['bidang_pekerjaan'] == "Pemasaran") {
                                                                                    echo 'selected';
                                                                                } ?>>Pemasaran</option>
                                               </select>
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