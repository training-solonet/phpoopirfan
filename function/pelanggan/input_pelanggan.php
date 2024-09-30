<?php
include('../../koneksi.php');
include('../pelanggan/pelanggan.php');

input_pelanggan($conn, $_POST['nama_pelanggan'], $_POST['alamat'], $_POST['telepon']);