<?php
function input_pelanggan($conn, $nama, $alamat, $telepon)
{
    // Asumsi id auto-increment

    // Sanitasi dan validasi input
    $nama = mysqli_real_escape_string($conn, $nama);
    $alamat = mysqli_real_escape_string($conn, $alamat);
    $telepon = (int) mysqli_real_escape_string($conn, $telepon); // Asumsi telepon berupa angka

    // Prepared statement
    $stmt = mysqli_prepare($conn, "INSERT INTO `pelanggan` (`nama_pelanggan`, `alamat`, `telepon`) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssi", $nama, $alamat, $telepon);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header('Location: ../../tampilan/pelanggan/index.php');
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

function update_pelanggan($conn, $id_pelanggan, $nama_pelanggan, $alamat, $telepon)
{
    // Sanitize inputs to prevent SQL injection
    $id_pelanggan = mysqli_real_escape_string($conn, $id_pelanggan);
    $nama_pelanggan = mysqli_real_escape_string($conn, $nama_pelanggan);
    $alamat = mysqli_real_escape_string($conn, $alamat);
    $telepon = mysqli_real_escape_string($conn, $telepon);

    // Construct the SQL query with proper string handling
    $sql = "UPDATE `pelanggan` SET 
            `nama_pelanggan` = '$nama_pelanggan', 
            `alamat` = '$alamat', 
            `telepon` = '$telepon' 
            WHERE `id_pelanggan` = '$id_pelanggan'";

    // Execute the query
    $query = mysqli_query($conn, $sql);

    // Check for errors
    if (!$query) {
        die("Error: " . mysqli_error($conn)); // Display detailed error
    } else {
        // Redirect to pelanggan.php after successful update
        header('Location: ../../tampilan/pelanggan/index.php');
        exit(); // Stop script execution after redirect
    }
}

function delete_pelanggan($conn, $id_pelanggan)
{
    // Ensure $id_pelanggan is treated as an integer to prevent SQL injection
    $id_pelanggan = intval($id_pelanggan);

    // First, delete any related entries from the detail_penjualan table
    $delete_detail_penjualan_sql = "DELETE FROM detail_penjualan WHERE id_penjualan IN (SELECT id_penjualan FROM penjual WHERE id_pelanggan = $id_pelanggan)";
    if (!mysqli_query($conn, $delete_detail_penjualan_sql)) {
        die("Error deleting related detail_penjualan entries: " . mysqli_error($conn));
    }

    // Now delete the entry from the penjual table
    $delete_penjual_sql = "DELETE FROM penjual WHERE id_pelanggan = $id_pelanggan";
    if (!mysqli_query($conn, $delete_penjual_sql)) {
        die("Error deleting penjual: " . mysqli_error($conn));
    }

    // Finally, delete the entry from the pelanggan table
    $delete_pelanggan_sql = "DELETE FROM pelanggan WHERE id_pelanggan = $id_pelanggan";
    if (mysqli_query($conn, $delete_pelanggan_sql)) {
        // Redirect on successful deletion
        header('Location: ../../tampilan/pelanggan/index.php');
        exit();
    } else {
        // Display error if deletion fails
        die("Error deleting pelanggan: " . mysqli_error($conn));
    }
}
