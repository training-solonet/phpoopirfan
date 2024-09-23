<?php
include('koneksi.php');
include('function.php');
input_barang($conn, $_POST['nama_barang'], $_POST['harga'], $_POST['stok']);
