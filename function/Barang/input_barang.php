<?php
include('../../koneksi.php');
include('../../function/Barang/barang.php');
input_barang($conn, $_POST['nama_barang'], $_POST['harga'], $_POST['stok']);
