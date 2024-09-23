<?php
include('function.php');
include('koneksi.php');

// Check if id_pelanggan is provided in the request
if (isset($_GET['id_barang'])) {
    // Call the delete function with the provided id
    delete_barang($conn, $_GET['id_barang']);
} else {
    // Show error message if id_pelanggan is not provided
    echo "ID barang tidak ditemukan, gagal menghapus pelanggan.";
}
