<?php
include('../../koneksi.php');
include('../../function/penjual/penjual.php');
include('../../bootsrap/bootsrap.php');
include('../komponen/sidebar.php');
?>

<div class="container-fluid">
    <div class="container col-9">
        <div class="container d-flex justify-content-between mt-5 ">
            <h2 class="text-center">Penjual</h2>
            <a href="../../tampilan/penjualan/index.php" class="btn btn-warning h-25 text-end">Tambah</a>
        </div>

        <div class="container">
            <div class="table-responsive">
                <?php
                $penjual_data = ambil_data_penjual($conn); // Ambil data penjual dari fungsi
                ?>

                <table class="table table-bordered table-striped">
                    <thead class="bg-info">
                        <tr class="text-center text-white">
                            <th>id</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($penjual_data as $penjual) :
                        ?>
                            <tr class="text-center">

                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($penjual['nama_pelanggan'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($penjual['tanggal'] ?? ''); ?></td>

                                <td>
                                    <!-- Tombol Edit -->
                                    <!-- <button class="btn btn-warning h-25 text-end" data-bs-toggle="modal" data-bs-target="#detailPenjualanModal">Detail Penjualan</button> -->
                                    <a href="detail.php?id=<?php echo $penjual['id_penjualan'] ?>" class="btn btn-warning h-25 text-end" data-id="<?php echo $penjual['id_penjualan']; ?>">Detail Penjualan</>


                                        <!-- Tombol Hapus -->
                                        <a href="../../function/penjual/delete_penjual.php?id_penjualan=<?php echo htmlspecialchars($penjual['id_penjualan'] ?? ''); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus pelanggan ini?')">Delete</a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>