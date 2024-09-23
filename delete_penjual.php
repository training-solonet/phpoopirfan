<?php
include('koneksi.php');
include('function.php');

if (isset($_GET['id_penjual'])) {
    delete_penjual($conn, $_GET['id_penjual']);
} else {
    echo "ID pelanggan tidak ditemukan, gagal menghapus penjual.";
}
