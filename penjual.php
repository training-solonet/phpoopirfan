<?php
include('koneksi.php');
include('function.php');
// include('input_pelanggan.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="sidebar-logo">
                    <h5 class="text-white">Side Menu</h5>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item my-3">
                    <a href="barang.php" class="sidebar-link text-decoration-none">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>Barang</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="pelanggan.php" class="sidebar-link text-decoration-none">
                        <i class="fa-solid fa-user"></i>
                        <span>Pelanggan</span>
                    </a>
                </li>
            </ul>
        </aside>

        <div class="container-fluid">
            <div class="container col-9">
                <div class="container d-flex justify-content-between mt-5 ">
                    <h2 class="text-center">Penjual</h2>
                    <button class="btn btn-warning h-25 text-end" data-bs-toggle="modal" data-bs-target="#addModal">Tambah</button>
                </div>

                <div class="container">
                    <div class="table-responsive">
                        <?php
                        $penjual_data = ambil_data_penjual($conn); // Ambil data penjual dari fungsi
                        ?>

                        <table class="table table-bordered table-striped">
                            <thead class="bg-info">
                                <tr class="text-center text-white">
                                    <th>ID Penjual</th>
                                    <th>Tanggal</th>
                                    <th>ID Pelanggan</th>
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
                                        <td><?php echo htmlspecialchars($penjual['tanggal'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($penjual['nama_pelanggan'] ?? ''); ?></td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-warning h-25 text-end" data-bs-toggle="modal" data-bs-target="#detailPenjualanModal">Detail Penjualan</button>

                                            <!-- Tombol Hapus -->
                                            <a href="delete_penjual.php?id_penjual=<?php echo htmlspecialchars($penjual['id_penjual'] ?? ''); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus penjual ini?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <!-- Modal Tambah Barang -->
                        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Tambah Penjualan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addForm" action="input_penjual.php" method="post">
                                            <?php
                                            $pelanggans = ambil_data_pelanggan($conn);

                                            ?>
                                            <div class="mb-3">
                                                <label for="id_pelanggan" class="form-label">ID Pelanggan</label>
                                                <!-- <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" required> -->
                                                <select name="id_pelanggan" class="form-control" id="id_pelanggan">
                                                    <?php foreach ($pelanggans as $pelanggan): ?>
                                                        <option value="<?php echo $pelanggan['id_pelanggan']; ?>">
                                                            <?php echo $pelanggan['nama_pelanggan']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="Tanggal" class="form-label">Tanggal</label>
                                                <input type="Date" class="form-control" id="tanggal" name="tanggal" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Tambah Pelanggan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Detail Penjualan -->
                        <div class="modal fade" id="detailPenjualanModal" tabindex="-1" aria-labelledby="detailPenjualanLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailPenjualanLabel">Detail Penjualan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Penjualan Detail Table -->

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nama Barang</th>
                                                    <th>ID Penjualan</th>
                                                    <th>Jumlah Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>SubTotal</th>
                                                </tr>
                                            </thead>
                                            <tbody id="penjualanDetailBody">
                                                <?php
                                                if (!empty($detailpenjual_data)) {
                                                    foreach ($detailpenjual_data as $dt) :
                                                ?>
                                                        <tr class="text-center">
                                                            <td><?php echo htmlspecialchars($dt['nama_barang'] ?? ''); ?></td>
                                                            <td><?php echo htmlspecialchars($dt['id_penjualan'] ?? ''); ?></td>
                                                            <td><?php echo htmlspecialchars($dt['jumlah'] ?? ''); ?></td>
                                                            <td><?php echo htmlspecialchars($dt['harga'] ?? ''); ?></td>
                                                            <td><?php echo htmlspecialchars($dt['jumlah'] * $dt['harga'] ?? ''); ?></td> <!-- Subtotal calculation -->
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
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
                        <script src="script.js"></script>
</body>