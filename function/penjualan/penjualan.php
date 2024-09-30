<?php 
function ambil_data_barang($conn)
{
    $sql = "SELECT
    keranjang.id_keranjang,
    barang.nama_barang,
    keranjang.id_barang,
    keranjang.jumlah_barang,
    keranjang.harga,
    keranjang.subtotal
FROM
    keranjang
    JOIN barang ON barang.id_barang = keranjang.id_barang";

    $query = mysqli_query($conn, $sql);
    $items = [];
    while ($row = mysqli_fetch_array($query)) {
        $items[] = array(
            'id_keranjang' => $row['id_keranjang'],
            'id_barang' => $row['id_barang'],
            'nama_barang' => $row['nama_barang'],
            'jumlah_barang' => $row['jumlah_barang'],
            'harga' => $row['harga'],
            'subtotal' => $row['subtotal'],
        );
    }
    return $items;
}
function input_penjualan($conn, $nama_pelanggan, $tanggal)
{
    $sql = "SELECT pelanggan.nama_pelanggan, penjual.tanggal
    FROM penjual
    JOIN pelanggan
    ON penjual.id_penjualan = pelanggan.id;";
    $query = mysqli_query($conn, $sql);
    if (!$query) {
        die("Error: " . mysqli_error($conn));
    } else {
        header('Location:penjualan.php');
    }
}

function update_penjualan($conn, $id, $nama_penjualan, $harga, $stok)
{
    $sql = "UPDATE `penjualan` SET `nama_penjualan`='$nama_penjualan', `harga`=$harga, `stok`=$stok WHERE `id_penjualan`=$id";
    $query = mysqli_query($conn, $sql);

    if (!$query) {
        die("Error: " . mysqli_error($conn));
    } else {
        header('Location: penjualan.php');
        exit(); // Menghentikan eksekusi setelah redirect
    }
}


function delete_penjualan($conn, $id_penjualan)
{
    // Sanitize the input to prevent SQL injection
    $id_penjualan = mysqli_real_escape_string($conn, $id_penjualan);

    // Construct the SQL query to delete the pelanggan (customer)
    $sql = "DELETE FROM `penjualan` WHERE `id_penjualan` = '$id_penjualan'";

    // Execute the query
    $query = mysqli_query($conn, $sql);

    // Check if the query was successful
    if (!$query) {
        die("Error deleting penjualan: " . mysqli_error($conn)); // Display error if query fails
    } else {
        // Redirect to pelanggan.php after successful deletion
        header('Location: penjualan.php');
        exit(); // Stop further script execution after redirect
    }
}