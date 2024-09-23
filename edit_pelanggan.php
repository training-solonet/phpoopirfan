<?php
include('function.php');
include('koneksi.php');

// Ensure all required POST data is sent
if (isset($_POST['id_pelanggan'], $_POST['nama_pelanggan'], $_POST['alamat'], $_POST['telepon'])) {
    // Call the function to update the pelanggan (customer) with the sanitized inputs
    update_pelanggan($conn, $_POST['id_pelanggan'], $_POST['nama_pelanggan'], $_POST['alamat'], $_POST['telepon']);
} else {
    // Show error message if data is incomplete
    echo "Data tidak lengkap, gagal mengupdate pelanggan.";
}
