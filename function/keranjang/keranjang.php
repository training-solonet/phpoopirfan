<?php
function input_keranjang($conn, $id_barang, $harga, $jumlah_barang)
{
    $subtotal = $harga * $jumlah_barang;

    // Perbaiki tipe data sesuai dengan kebutuhan
    $sql = "INSERT INTO `keranjang` (`id_barang`, `jumlah_barang`, `harga`, `subtotal`) 
            VALUES ('$id_barang', '$jumlah_barang', '$harga', '$subtotal')";

    $query = mysqli_query($conn, $sql);

    if (!$query) {
        die("Error: " . mysqli_error($conn));
    }
}


function ambil_data_keranjang($conn)
{
    $sql = "SELECT * FROM `keranjang` WHERE `id_penjualan` IS NULL";
    $result = mysqli_query($conn, $sql);

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array(
            'id_keranjang' => $row['id_keranjang'],
            'id_barang' => $row['id_barang'],
            'harga' => $row['harga'],
            'jumlah_barang' => $row['jumlah_barang'],
            'subtotal' => $row['subtotal'],

        );
    }

    return $data;
}

function delete_keranjang($conn, $id_keranjang)
{
    // Ensure the $id_keranjang is an integer to prevent SQL injection
    $id_keranjang = intval($id_keranjang);

    // Create the SQL query
    $sql = "DELETE FROM keranjang WHERE id_keranjang = $id_keranjang";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect on successful deletion
        header('Location: ../../tampilan/penjualan/index.php'); // Adjust the redirection path as needed
        exit();
    } else {
        // Display error if deletion fails
        die("Error deleting keranjang: " . $conn->error);
    }
}
