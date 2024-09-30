<?php
include('../../koneksi.php');
include('../../function/Barang/barang.php');

if (isset($_POST['id_barang'], $_POST['nama_barang'], $_POST['harga'], $_POST['stok'])) {
    // Call the function to update barang with the sanitized inputs
    update_barang($conn, $_POST['id_barang'], $_POST['nama_barang'], $_POST['harga'], $_POST['stok']);
} else {
    // Show error message if data is incomplete
    echo "Data tidak lengkap, gagal mengupdate barang.";
}