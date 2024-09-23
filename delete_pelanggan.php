<?php
include('koneksi.php');
include('function.php');

// Check if id_pelanggan is provided in the request
if (isset($_GET['id_pelanggan'])) {
    // Call the delete function with the provided id
    delete_pelanggan($conn, $_GET['id_pelanggan']);
} else {
    // Show error message if id_pelanggan is not provided
    echo "ID pelanggan tidak ditemukan, gagal menghapus pelanggan.";
}
