<?php
include('../../koneksi.php');
include('../../function/keranjang/keranjang.php');

if (isset($_GET['id_keranjang'])) {
    // Ensure $id_keranjang is an integer to avoid any issues
    $id_keranjang = intval($_GET['id_keranjang']);
    
    // Call the delete function to delete the record
    delete_keranjang($conn, $id_keranjang);
} else {
    echo "ID keranjang tidak ditemukan, gagal menghapus keranjang.";
}

