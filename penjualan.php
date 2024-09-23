<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan</title>
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
            </ul>
        </aside>
        <div class="container-fluid">
            <div class="container mt-5">
                <!-- title transaksi penjualan -->
                <div class="text-center">
                    <h3>Transaksi Penjualan</h3>
                    <h5>No Invoice : XXXXX</h5>
                    <hr>
                </div>
                <!-- form transaksi penjualan -->
                <form action="" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pelanggan">Pelanggan</label>
                                <select class="form-control" id="pelanggan" name="pelanggan">
                                    <option value="">Pilih Pelanggan</option>
                                    <option value="1">Pelanggan 1</option>
                                    <option value="2">Pelanggan 2</option>
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
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Barang 1</td>
                                <td>2</td>
                                <td>Rp. 100.000</td>
                                <td>Rp. 200.000</td>
                                <td>
                                    <button class="btn btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Barang 2</td>
                                <td>3</td>
                                <td>Rp. 200.000</td>
                                <td>Rp. 600.000</td>
                                <td>
                                    <button class="btn btn-danger">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-center">Total</td>
                                <td colspan="2">Rp. 800.000</td>
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
                                <div class="row">
                                    <div class="col-4">
                                        <div class="modal-body">
                                            <!-- card barang -->
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img src="https://via.placeholder.com/150" class="img-fluid" alt="...">
                                                        </div>
                                                        <div class="col-8">
                                                            <h5 class="card-title">Nama Barang</h5>
                                                            <p class="card-text">Rp. 100.000</p>
                                                            <p class="card-text">Stok : 10</p>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group">
                                                                <input type="number" class="form-control" placeholder="Qty" aria-label="Qty" aria-describedby="button-addon2">
                                                                <button class="btn btn-primary" type="button" id="button-addon2">Tambah</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="modal-body">
                                            <!-- card barang -->
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img src="https://via.placeholder.com/150" class="img-fluid" alt="...">
                                                        </div>
                                                        <div class="col-8">
                                                            <h5 class="card-title">Nama Barang</h5>
                                                            <p class="card-text">Rp. 100.000</p>
                                                            <p class="card-text">Stok : 10</p>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group">
                                                                <input type="number" class="form-control" placeholder="Qty" aria-label="Qty" aria-describedby="button-addon2">
                                                                <button class="btn btn-primary" type="button" id="button-addon2">Tambah</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="modal-body">
                                            <!-- card barang -->
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img src="https://via.placeholder.com/150" class="img-fluid" alt="...">
                                                        </div>
                                                        <div class="col-8">
                                                            <h5 class="card-title">Nama Barang</h5>
                                                            <p class="card-text">Rp. 100.000</p>
                                                            <p class="card-text">Stok : 10</p>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group">
                                                                <input type="number" class="form-control" placeholder="Qty" aria-label="Qty" aria-describedby="button-addon2">
                                                                <button class="btn btn-primary" type="button" id="button-addon2">Tambah</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="modal-body">
                                            <!-- card barang -->
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img src="https://via.placeholder.com/150" class="img-fluid" alt="...">
                                                        </div>
                                                        <div class="col-8">
                                                            <h5 class="card-title">Nama Barang</h5>
                                                            <p class="card-text">Rp. 100.000</p>
                                                            <p class="card-text">Stok : 10</p>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group">
                                                                <input type="number" class="form-control" placeholder="Qty" aria-label="Qty" aria-describedby="button-addon2">
                                                                <button class="btn btn-primary" type="button" id="button-addon2">Tambah</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="modal-body">
                                            <!-- card barang -->
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img src="https://via.placeholder.com/150" class="img-fluid" alt="...">
                                                        </div>
                                                        <div class="col-8">
                                                            <h5 class="card-title">Nama Barang</h5>
                                                            <p class="card-text">Rp. 100.000</p>
                                                            <p class="card-text">Stok : 10</p>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group">
                                                                <input type="number" class="form-control" placeholder="Qty" aria-label="Qty" aria-describedby="button-addon2">
                                                                <button class="btn btn-primary" type="button" id="button-addon2">Tambah</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="modal-body">
                                            <!-- card barang -->
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img src="https://via.placeholder.com/150" class="img-fluid" alt="...">
                                                        </div>
                                                        <div class="col-8">
                                                            <h5 class="card-title">Nama Barang</h5>
                                                            <p class="card-text">Rp. 100.000</p>
                                                            <p class="card-text">Stok : 10</p>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group">
                                                                <input type="number" class="form-control" placeholder="Qty" aria-label="Qty" aria-describedby="button-addon2">
                                                                <button class="btn btn-primary" type="button" id="button-addon2">Tambah</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>