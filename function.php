<?php

//BARANG//
function input_barang($conn, $nama, $harga, $stok)
{
    $sql = "INSERT INTO `barang` (`nama_barang`, `harga`, `stok`) VALUES ('" . $nama . "', " . $harga . ", " . $stok . ")";
    $query = mysqli_query($conn, $sql);
    if (!$query) {
        die("Error: " . mysqli_error($conn));
    } else {
        header('Location:barang.php');
    }
}

function update_barang($conn, $id, $nama_barang, $harga, $stok)
{
    $sql = "UPDATE `barang` SET `nama_barang`='$nama_barang', `harga`=$harga, `stok`=$stok WHERE `id_barang`=$id";
    $query = mysqli_query($conn, $sql);

    if (!$query) {
        die("Error: " . mysqli_error($conn));
    } else {
        header('Location: barang.php');
        exit(); // Menghentikan eksekusi setelah redirect
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
            'detail_penjualan' => $row['id_barang']
        );
    }
    return $items;
}



function delete_barang($conn, $id_barang)
{
    // Sanitize the input to prevent SQL injection
    $id_barang = mysqli_real_escape_string($conn, $id_barang);

    // Construct the SQL query to delete the pelanggan (customer)
    $sql = "DELETE FROM `barang` WHERE `id_barang` = '$id_barang'";

    // Execute the query
    $query = mysqli_query($conn, $sql);

    // Check if the query was successful
    if (!$query) {
        die("Error deleting barang: " . mysqli_error($conn)); // Display error if query fails
    } else {
        // Redirect to pelanggan.php after successful deletion
        header('Location: barang.php');
        exit(); // Stop further script execution after redirect
    }
}






//PELANGGAN//
function input_pelanggan($conn, $nama, $alamat, $telepon)
{
    // Asumsi id_pelanggan auto-increment

    // Sanitasi dan validasi input
    $nama = mysqli_real_escape_string($conn, $nama);
    $alamat = mysqli_real_escape_string($conn, $alamat);
    $telepon = (int) mysqli_real_escape_string($conn, $telepon); // Asumsi telepon berupa angka

    // Prepared statement
    $stmt = mysqli_prepare($conn, "INSERT INTO `pelanggan` (`nama_pelanggan`, `alamat`, `telepon`) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssi", $nama, $alamat, $telepon);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header('Location: pelanggan.php');
    } else {
        die("Error: " . mysqli_error($conn));
    }
}

function ambil_data_pelanggan($conn)
{
    $sql = "SELECT * FROM pelanggan";
    $query = mysqli_query($conn, $sql);
    $items = [];
    while ($row = mysqli_fetch_array($query)) {
        $items[] = array('id_pelanggan' => $row['id_pelanggan'], 'nama_pelanggan' => $row['nama_pelanggan'], 'alamat' => $row['alamat'], 'telepon' => $row['telepon']);
    }
    return $items;
}

function update_pelanggan($conn, $id, $nama_pelanggan, $alamat, $telepon)
{
    // Sanitize inputs to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $id);
    $nama_pelanggan = mysqli_real_escape_string($conn, $nama_pelanggan);
    $alamat = mysqli_real_escape_string($conn, $alamat);
    $telepon = mysqli_real_escape_string($conn, $telepon);

    // Construct the SQL query with proper string handling
    $sql = "UPDATE `pelanggan` SET 
            `nama_pelanggan` = '$nama_pelanggan', 
            `alamat` = '$alamat', 
            `telepon` = '$telepon' 
            WHERE `id_pelanggan` = '$id'";

    // Execute the query
    $query = mysqli_query($conn, $sql);

    // Check for errors
    if (!$query) {
        die("Error: " . mysqli_error($conn)); // Display detailed error
    } else {
        // Redirect to pelanggan.php after successful update
        header('Location: pelanggan.php');
        exit(); // Stop script execution after redirect
    }
}

function delete_pelanggan($conn, $id_pelanggan)
{
    // Sanitize the input to prevent SQL injection
    $id_pelanggan = mysqli_real_escape_string($conn, $id_pelanggan);

    // Construct the SQL query to delete the pelanggan (customer)
    $sql = "DELETE FROM `pelanggan` WHERE `id_pelanggan` = '$id_pelanggan'";

    // Execute the query
    $query = mysqli_query($conn, $sql);

    // Check if the query was successful
    if (!$query) {
        die("Error deleting pelanggan: " . mysqli_error($conn) . " | Query: " . $sql); // Display detailed error
    } else {
        // Redirect to pelanggan.php after successful deletion
        header('Location: pelanggan.php');
        exit(); // Stop further script execution after redirect
    }
}






//PENJUAL//
function input_penjual($conn, $id_penjualan, $id_pelanggan, $tanggal)
{
    // Sanitasi dan validasi input
    $id_penjualan = mysqli_real_escape_string($conn, $id_penjualan);
    $id_pelanggan = mysqli_real_escape_string($conn, $id_pelanggan);
    $tanggal = mysqli_real_escape_string($conn, $tanggal);

    // Prepared statement
    $stmt = mysqli_prepare($conn, "INSERT INTO penjual (id_penjualan, id_pelanggan, tanggal) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iis", $id_penjualan, $id_pelanggan, $tanggal); // 'i' for integer, 's' for string

    // Execute statement
    mysqli_stmt_execute($stmt);

    // Check if insertion was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header('Location: penjual.php');
        exit(); // Call exit after header redirect
    } else {
        die("Error: " . mysqli_error($conn));
    }
}





function ambil_data_penjual($conn)
{
    $query = "SELECT penjual.tanggal, penjual.id_penjualan, pelanggan.nama_pelanggan FROM penjual JOIN pelanggan on pelanggan.id_pelanggan=penjual.id_penjualan"; // Add semicolon here

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}


function delete_penjual($conn, $id_penjualan)
{
    // Sanitize the input to prevent SQL injection
    $id_penjual = mysqli_real_escape_string($conn, $id_penjualan);

    // Construct the SQL query to delete the pelanggan (customer)
    $sql = "DELETE FROM `penjual` WHERE `id_penjualan` = '$id_penjualan'";

    // Execute the query
    $query = mysqli_query($conn, $sql);

    // Check if the query was successful
    if (!$query) {
        die("Error deleting penjual: " . mysqli_error($conn) . " | Query: " . $sql); // Display detailed error
    } else {
        // Redirect to pelanggan.php after successful deletion
        header('Location: penjual.php');
        exit(); // Stop further script execution after redirect
    }
}






        // detail penjualan
        function ambil_data_penjualan($conn)
{
    $query = "SELECT pnj.id_penjualan, brg.nama_barang, dpnj.jumlah, brg.harga, (dpnj.jumlah * brg.harga) AS subtotal
    FROM penjual AS pnj
        JOIN pelanggan AS png ON png.id_pelanggan=pnj.id_pelanggan
        JOIN detail_penjualan AS dpnj ON pnj.id_penjualan=dpnj.id_penjualan 
        JOIN barang AS brg ON dpnj.id_barang=brg.id_barang
    WHERE pnj.id_penjualan = 1"; // Adjust the condition as needed

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

