<?php
include('koneksi.php');
include('function.php');

input_pelanggan($conn, $_POST['nama_pelanggan'], $_POST['alamat'], $_POST['telepon']);