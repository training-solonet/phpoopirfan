<?php 
function input_barang($conn, $nama, $harga, $stok)
{
    $sql = "INSERT INTO `barang` (`nama_barang`, `harga`, `stok`) VALUES ('" . $nama . "', " . $harga . ", " . $stok . ")";
    $query = mysqli_query($conn, $sql);
    if (!$query) {
        die("Error: " . mysqli_error($conn));
    } else {
        header('Location:../../tampilan/barang/index.php');
    }
}

function update_barang($conn, $id_barang, $nama_barang, $harga, $stok)
{
    // Sanitize inputs to prevent SQL injection
    $id_barang = mysqli_real_escape_string($conn, $id_barang);
    $nama_barang = mysqli_real_escape_string($conn, $nama_barang);
    $harga = mysqli_real_escape_string($conn, $harga);
    $stok = mysqli_real_escape_string($conn, $stok);

    // Construct the SQL query
    $sql = "UPDATE `barang` 
            SET `nama_barang` = '$nama_barang', 
                `harga` = '$harga', 
                `stok` = '$stok' 
            WHERE `id_barang` = '$id_barang'";

    // Execute the query
    $query = mysqli_query($conn, $sql);

    // Check for errors
    if (!$query) {
        // Display detailed error
        die("Error: " . mysqli_error($conn));
    } else {
        // Redirect to index.php after successful update
        header('Location: ../../tampilan/barang/index.php');
        exit(); // Stop script execution after redirect
    }
}

function ambil_data($conn)
{
    $sql = "SELECT barang.id_barang, barang.nama_barang, barang.harga, barang.stok
            FROM barang";

    $query = mysqli_query($conn, $sql);
    $items = [];
    while ($row = mysqli_fetch_array($query)) {
        $items[] = array(
            'id_barang' => $row['id_barang'],
            'nama_barang' => $row['nama_barang'],
            'harga' => $row['harga'],
            'stok' => $row['stok'],

        );
    }
    return $items;
}

function delete_barang($conn, $id_barang)
{
    // Ensure $id_barang is treated as an integer to prevent SQL injection
    $id_barang = intval($id_barang);

    // First, delete any related entries from the keranjang table
    $delete_keranjang_sql = "DELETE FROM keranjang WHERE id_barang = $id_barang";
    if (!mysqli_query($conn, $delete_keranjang_sql)) {
        die("Error deleting related keranjang entries: " . mysqli_error($conn));
    }

    // Now delete the entry from the barang table
    $delete_barang_sql = "DELETE FROM barang WHERE id_barang = $id_barang";
    if (mysqli_query($conn, $delete_barang_sql)) {
        // Redirect on successful deletion
        header('Location: ../../tampilan/barang/index.php');
        exit();
    } else {
        // Display error if deletion fails
        die("Error deleting barang: " . mysqli_error($conn));
    }
}
