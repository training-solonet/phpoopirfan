<?php
include('../../koneksi.php');
include('../../function/Barang/barang.php');

if (isset($_GET['id_barang'])) {
    // Ensure $id_barang is an integer to avoid any issues
    $id_barang = intval($_GET['id_barang']);
    
    // Call the delete function to delete the record
    delete_barang($conn, $id_barang);
} else {
    echo "ID barang tidak ditemukan, gagal menghapus barang.";
}