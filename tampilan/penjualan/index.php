<?php
include('../../koneksi.php');
include('../../function/penjualan/penjualan.php');
include('../../function/pelanggan/pelanggan.php');
include('../../function/keranjang/keranjang.php');
include('../../function/barang/barang.php');
include('../../bootsrap/bootsrap.php');
include('../komponen/sidebar.php');
?>

<div class="container mt-5 mx-auto" style="max-width: 1000px;">
    <div class="text-center">
        <h3>Transaksi Penjualan</h3>
        <h5>No Invoice : XXXXX</h5>
        <hr>
    </div>

    <!-- form transaksi penjualan -->
    <form action="../../function/penjual/input_pejual.php" method="post">
        <?php
        $pelanggans = ambil_data_pelanggan($conn);
        ?>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="pelanggan">Pilih Pelanggan</label>
                    <select name="id_pelanggan" class="form-control" id="id">
                        <option value="" disabled selected>Pilih Pelanggan</option>
                        <?php foreach ($pelanggans as $pelanggan): ?>
                            <option value="<?php echo $pelanggan['id_pelanggan']; ?>">
                                <?php echo $pelanggan['nama_pelanggan']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d') ?>">
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex flex-row-reverse bd-highlight">
                    <div class="p-2 bd-highlight">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                            Tambah Barang
                        </button>
                    </div>
                    <div class="p-2 bd-highlight">
                        <button type="submit" class="btn btn-success">Simpan Penjualan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="table-responsive mt-2">
        <table class="table table-bordered table-striped">
            <thead class="bg-info">
                <tr class="text-center text-white">
                    <th>No</th>
                    <th>Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $items = ambil_data_keranjang($conn);
                $total = 0;
                foreach ($items as $item):
                    $total +=  $item['subtotal'];
                ?>
                    <tr class="text-center">
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $item['id_barang']; ?></td>
                        <td><?php echo $item['jumlah_barang']; ?></td>
                        <td>Rp. <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                        <td>Rp. <?php echo number_format($item['subtotal'], 0, ',', '.'); ?></td>
                        <td>
                        <a href="../../function/keranjang/delete_keranjang.php?id_keranjang=<?php echo htmlspecialchars($item['id_keranjang']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus item ini?')">Hapus</a>


                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-center">Total</td>
                    <td colspan="2">Rp. <?php echo number_format($total); ?></td>
                </tr>
            </tfoot>
        </table>

        <!-- Modal Tambah Barang -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <?php
                                $data = ambil_data($conn);
                                $count = 0;
                                foreach ($data as $dt):
                                    if ($count % 3 == 0 && $count != 0) {
                                        echo '</div><div class="row mt-3">';
                                    }
                                ?>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="https://via.placeholder.com/150" class="img-fluid" alt="...">
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 class="card-title"><?php echo $dt['nama_barang']; ?></h5>
                                                        <p class="card-text">Rp. <?php echo number_format($dt['harga']); ?></p>
                                                        <p class="card-text">Stok : <?php echo $dt['stok']; ?></p>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-group">
                                                            <form action="../../function/keranjang/input_keranjang.php" method="post">
                                                                <input type="hidden" name="id_barang" value="<?php echo $dt['id_barang']; ?>">
                                                                <input type="hidden" name="harga" value="<?php echo $dt['harga']; ?>">
                                                                <input type="number" name="jumlah_barang" class="form-control" placeholder="jumlah" aria-label="jumlah" aria-describedby="button-addon2" min="0" required>
                                                                <button class="btn btn-primary m-1" type="submit" id="button-addon2">Submit</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $count++;
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</body>

</html>