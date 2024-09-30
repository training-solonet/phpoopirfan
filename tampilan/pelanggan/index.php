<?php
include('../../koneksi.php');
include('../../function/pelanggan/pelanggan.php');
include('../../bootsrap/bootsrap.php');
include('../komponen/sidebar.php');
?>

        <div class="container-fluid">
            <div class="container col-9">
                <div class="container d-flex justify-content-between mt-5">
                    <h2 class="text-center">Pelanggan</h2>
                    <button class="btn btn-warning h-25" data-bs-toggle="modal" data-bs-target="#addModal">Tambah</button>
                </div>

                <div class="container">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-info">
                                <tr class="text-center text-white">
                                    <th>Id</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = "1";
                                $data = ambil_data_pelanggan($conn); // Fetch data from the function
                                foreach (ambil_data_pelanggan($conn)  as $dt):
                                ?>
                                    <tr class="text-center">
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo htmlspecialchars($dt['nama_pelanggan'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($dt['alamat'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($dt['telepon'] ?? ''); ?></td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo htmlspecialchars($dt['id_pelanggan'] ?? ''); ?>">Edit</button>

                                            <!-- Tombol Hapus -->
                                            <a href="../../function/pelanggan/delete_pelanggan.php?id_pelanggan=<?php echo htmlspecialchars($dt['id_pelanggan'] ?? ''); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus pelanggan ini?')">Delete</a>

                                        </td>
                                    </tr>

                                    <!-- Modal Edit untuk setiap barang -->
                                    <div class="modal fade" id="editModal<?php echo htmlspecialchars($dt['id_pelanggan'] ?? ''); ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo htmlspecialchars($dt['id_Pelanggan'] ?? ''); ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel<?php echo htmlspecialchars($dt['id_pelanggan'] ?? ''); ?>">Edit Pelanggan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        &times;
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../../function/pelanggan/edit_pelanggan.php" method="post">
                                                        <input type="hidden" name="id_pelanggan" value="<?php echo htmlspecialchars($dt['id_pelanggan'] ?? ''); ?>">
                                                        <div class="mb-3">
                                                            <label for="nama_Pelanggan" class="form-label">Nama Pelanggan</label>
                                                            <input type="text" class="form-control" name="nama_pelanggan" value="<?php echo htmlspecialchars($dt['nama_pelanggan'] ?? ''); ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="alamat" class="form-label">Alamat</label>
                                                            <input type="text" class="form-control" name="alamat" value="<?php echo htmlspecialchars($dt['alamat'] ?? ''); ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="telepon" class="form-label">Telepon</label>
                                                            <input type="text" class="form-control" name="telepon" value="<?php echo htmlspecialchars($dt['telepon'] ?? ''); ?>" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <!-- Modal Tambah Barang -->
                        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Tambah Pelanggan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            &times;
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addForm" action="../../function/pelanggan/input_pelanggan.php" method="post">
                                            <div class="mb-3">
                                                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                                                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <input type="text" class="form-control" id="alamat" name="alamat" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="telepon" class="form-label">Telepon</label>
                                                <input type="text" class="form-control" id="telepon" name="telepon" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Tambah Pelanggan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
                        <script src="script.js"></script>
</body>

</html> -->
