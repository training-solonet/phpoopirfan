<?php
include('../../koneksi.php');
include('../../function/penjual/penjual.php');


if (isset($_GET['id_penjualan'])) {
    // Ensure $id_penjual is an integer to avoid any issues
    $id_penjual = intval($_GET['id_penjualan']);
    
    // Call the delete function to delete the record
    delete_penjual($conn, $id_penjual); // Correct function name
} else {
    echo "ID penjual tidak ditemukan, gagal menghapus penjual.";
}