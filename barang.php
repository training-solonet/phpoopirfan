<?php
include('koneksi.php');
include('function.php');
?>

<!DOCTYPE html>
<html lang="en">

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
                    <h5 class="text-white">Side Menu </h5>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="pelanggan.php" class="sidebar-link text-decoration-none">
                        <i class="fa-solid fa-user"></i>
                        <span>Pelanggan</span>
                    </a>
                </li>
                <li class="sidebar-item my-3">
                    <a href="penjual.php" class="sidebar-link text-decoration-none">
                        <i class="fa-solid fa-shop"></i>
                        <span>Penjual</span>
                    </a>
                </li>
                <!-- <li class="sidebar-item">
                    <a href=".php" class="sidebar-link text-decoration-none">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>Barang</span>
                    </a>
                </li> -->
            </ul>
        </aside>
        <div class="container-fluid">
            <div class="container col-9">
                <div class="container d-flex justify-content-between  mt-5">
                    <h2 class="text-center">Barang</h2>
                    <button class="btn btn-warning  h-25" data-bs-toggle="modal" data-bs-target="#addModal">Tambah</button>
                </div>

                <div class="container">
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-info">
                                <tr class="text-center text-white">
                                    <th>Id</th>
                                    <th>Nama barang</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = "1";
                                $data = ambil_data($conn); // Fetch data from the function
                                // var_dump($data);
                                // die();
                                foreach (ambil_data($conn)  as $dt):
                                ?>
                                    <tr class="text-center">
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $dt['nama_barang']; ?></td>
                                        <td>Rp. <?php echo number_format($dt['harga'],); ?></td>
                                        <td><?php echo $dt['stok']; ?></td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $dt['id_barang']; ?>">Edit</button>

                                            <!-- Tombol Hapus -->
                                            <a href="delete_barang.php?id_barang=<?php echo $dt['id_barang']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus barang ini?')">Delete</a>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit untuk setiap barang -->
                                    <div class="modal fade" id="editModal<?php echo $dt['id_barang']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $dt['id_barang']; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel<?php echo $dt['id_barang']; ?>">Edit Barang</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        &times;
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="edit_barang.php" method="post">
                                                        <input type="hidden" name="id_barang" value="<?php echo $dt['id_barang']; ?>">
                                                        <div class="mb-3">
                                                            <label for="nama_barang" class="form-label">Nama Barang</label>
                                                            <input type="text" class="form-control" name="nama_barang" value="<?php echo $dt['nama_barang']; ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="harga" class="form-label">Harga</label>
                                                            <input type="number" class="form-control" name="harga" value="<?php echo number_format($dt['harga'], 2, '.', ''); ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="stok" class="form-label">Stok</label>
                                                            <input type="number" class="form-control" name="stok" value="<?php echo $dt['stok']; ?>" required>
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
                                        <h5 class="modal-title" id="addModalLabel">Tambah Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            &times;
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addForm" action="input_barang.php" method="post">
                                            <div class="mb-3">
                                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="harga" class="form-label">Harga</label>
                                                <input type="number" class="form-control" id="harga" name="harga" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="stok" class="form-label">Stok</label>
                                                <input type="number" class="form-control" id="stok" name="stok" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Tambah Barang</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
                        <script src="script.js"></script>
</body>

</html>