<?php 
// Include koneksi dan file yang berisi fungsi penjualan
include ('../../koneksi.php');
include ('../../function/penjual/penjual.php'); 

// Ambil data dari POST
$id_pelanggan = $_POST['id_pelanggan'] ?? null; 
$tanggal = $_POST['tanggal'] ?? date('Y-m-d'); // Default to today's date if not set

// Validasi id_pelanggan
if ($id_pelanggan === null) {
    die("Error: id_pelanggan cannot be null.");
}

// Pastikan bahwa function input_penjual tersedia
if (function_exists('input_penjual')) {
    // Panggil function untuk memasukkan data ke dalam tabel penjual
    input_penjual($conn, $id_pelanggan, $tanggal);
} else {
    // Jika function tidak ditemukan
    die("Error: Function input_penjual() not found.");
}
?>
