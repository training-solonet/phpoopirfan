<?php
include('function.php');
include('koneksi.php');

// Pastikan semua data dikirim melalui POST
if(isset($_POST['id_barang']) && isset($_POST['nama_barang']) && isset($_POST['harga']) && isset($_POST['stok'])) {
    // Panggil fungsi update_barang dengan parameter yang benar
    update_barang($conn, $_POST['id_barang'], $_POST['nama_barang'], $_POST['harga'], $_POST['stok']);
} else {
    // Jika data tidak lengkap, tampilkan pesan kesalahan
    echo "Data tidak lengkap, gagal mengupdate barang.";
}
