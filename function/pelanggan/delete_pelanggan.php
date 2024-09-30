<?php
include('../../koneksi.php');
include('../pelanggan/pelanggan.php');

if (isset($_GET['id_pelanggan'])) { // Corrected the variable name here
    // Ensure $id_pelanggan is an integer to avoid any issues
    $id_pelanggan = intval($_GET['id_pelanggan']); // Changed variable name for consistency
    
    // Call the delete function to delete the record
    delete_pelanggan($conn, $id_pelanggan); // Pass the correct variable
} else {
    echo "ID pelanggan tidak ditemukan, gagal menghapus pelanggan.";
}