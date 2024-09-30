<?php
include('../../koneksi.php');
include('../../function/keranjang/keranjang.php');
if (isset($_POST['id_barang'])) {
    $id_barang = $_POST['id_barang'];
    $harga = $_POST['harga'];
    $jumlah_barang = $_POST['jumlah_barang'];

    // Cek apakah item sudah ada di keranjang
    $result = mysqli_query($conn, "SELECT jumlah_barang FROM keranjang WHERE id_barang = $id_barang");
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $jumlah_barang += $row['jumlah_barang'];
        $subtotal = $harga * $jumlah_barang;

        // Update jumlah dan subtotal
        mysqli_query($conn, "UPDATE keranjang SET jumlah_barang = $jumlah_barang, subtotal = $subtotal WHERE id_barang = $id_barang");
    } else {
        // Insert data baru ke keranjang
        $subtotal = $harga * $jumlah_barang;
        mysqli_query($conn, "INSERT INTO keranjang (id_barang, harga, jumlah_barang, subtotal) 
                             VALUES ($id_barang, $harga, $jumlah_barang, $subtotal)");
    }

    header("Location: ../../tampilan/penjualan/index.php");
    exit();
}
?>
