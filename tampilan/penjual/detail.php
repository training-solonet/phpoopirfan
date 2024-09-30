<?php
include('../../function/penjual/penjual.php');
include('../../koneksi.php');
include('../../tampilan/komponen/sidebar.php');
include('../../bootsrap/bootsrap.php')
?>

<div class="modal-body mt-5">
    <div class="d-flex justify-content-center">
    <!-- Penjualan Detail Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th><i class="fas fa-box"></i> Nama Barang</th>
                            <th><i class="fas fa-receipt"></i> ID Penjualan</th>
                            <th><i class="fas fa-cubes"></i> Jumlah Barang</th>
                            <th><i class="fas fa-calculator"></i> SubTotal</th>
                        </tr>
                    </thead>
                    <tbody id="penjualanDetailBody">
                        <?php
                        $ambil_data_detail = ambil_data_detail($_GET['id']); // Pastikan ini sudah dipanggil

                        if (!empty($ambil_data_detail)) {
                            foreach ($ambil_data_detail as $dt) :
                        ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($dt['nama_barang'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($dt['id_barang'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($dt['jumlah_barang'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($dt['subtotal'] ?? ''); ?></td>
                                    </td>
                                </tr>
                        <?php
                            endforeach;
                        } else {
                            echo "<tr><td colspan='5'>No data available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>