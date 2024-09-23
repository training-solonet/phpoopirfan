<?php
// input_penjual.php

// input_penjual.php

// Include the function file
include 'koneksi.php';
include 'function.php';

// Sample data (replace with actual POST data or other dynamic input)
// No need for an array here, use simple values
$id_penjualan = '1'; // Replace with actual data from a form (e.g., $_POST['id_penjualan'])
$id_pelanggan = '5'; // ID of the customer (pelanggan)
$tanggal = '2024-05-09'; // Sale date

// Call the input_penjual function to insert the data
input_penjual($conn, $id_penjualan, $id_pelanggan, $tanggal);

$id_penjualan = $_POST['id_penjualan'];
$id_pelanggan = $_POST['id_pelanggan'];
$tanggal = $_POST['tanggal'];
