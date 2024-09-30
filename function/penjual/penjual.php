<?php

function ambil_data_penjual($conn)
{
    $sql = "SELECT
    penjual.id_penjualan,
    penjual.tanggal,
    pelanggan.nama_pelanggan
FROM
    penjual
    JOIN pelanggan ON penjual.id_pelanggan = pelanggan.id_pelanggan;
";

    $query = mysqli_query($conn, $sql);
    $items = [];
    while ($row = mysqli_fetch_array($query)) {
        $items[] = array(
            'id_penjualan' => $row['id_penjualan'],
            'tanggal' => $row['tanggal'],
            'nama_pelanggan' => $row['nama_pelanggan'],
        );
    }
    return $items;
}
function input_penjual($conn, $id_pelanggan, $tanggal)
{
    // Check if id_pelanggan is not null
    if (is_null($id_pelanggan)) {
        die("Error: id_pelanggan cannot be null.");
    }

    // Masukkan ke table penjual
    mysqli_query($conn, "INSERT INTO `penjual` (`id_pelanggan`, `tanggal`) VALUES ('$id_pelanggan', '$tanggal')");

    // Ambil data dari table penjual order by id desc
    $sql = "SELECT * FROM penjual ORDER BY id_penjualan DESC LIMIT 1";
    $query = mysqli_query($conn, $sql);
    $id_penjualan = '';
    if ($row = mysqli_fetch_array($query)) {
        $id_penjualan = $row['id_penjualan'];
    }


    // Ambil data dari table keranjang
    $sql = "SELECT * FROM keranjang";
    $query = mysqli_query($conn, $sql);
    $items = [];
    while ($row = mysqli_fetch_array($query)) {
        $id_barang = $row['id_barang'];
        $jumlah_barang = $row['jumlah_barang'];
        $subtotal = $row['subtotal'];

        // Insert ke table detail_penjualan
        mysqli_query($conn, "INSERT INTO `detail_penjualan` (`id_penjualan`, `id_barang`, `jumlah_barang`, `subtotal`) VALUES ('$id_penjualan', '$id_barang', '$jumlah_barang', '$subtotal')");

        $items[] = array(
            'id_barang'      => $id_barang,
            'jumlah_barang'  => $jumlah_barang,
            'subtotal'       => $subtotal,
        );
    }

    header('location:../../tampilan/penjual/index.php');
}



function delete_penjual($conn, $id_penjual)
{
    // Ensure $id_penjual is treated as an integer to prevent SQL injection
    $id_penjual = intval($id_penjual);

    // First, delete any related entries from the detail_penjualan table
    $delete_keranjang_sql = "DELETE FROM detail_penjualan WHERE id_penjualan = $id_penjual"; // Check table name
    if (!mysqli_query($conn, $delete_keranjang_sql)) {
        die("Error deleting related keranjang entries: " . mysqli_error($conn));
    }

    // Now delete the entry from the penjual table
    $delete_penjual_sql = "DELETE FROM penjual WHERE id_penjualan = $id_penjual"; // Corrected variable name
    if (mysqli_query($conn, $delete_penjual_sql)) {
        // Redirect on successful deletion
        header('Location: ../../tampilan/penjual/index.php');
        exit();
    } else {
        // Display error if deletion fails
        die("Error deleting penjual: " . mysqli_error($conn));
    }
}






function ambil_data_detail($id_penjualan)
{
    global $conn; // Pastikan menggunakan koneksi yang benar
    $sql = "SELECT dpjl.id_barang, brg.nama_barang, dpjl.jumlah_barang, dpjl.subtotal FROM penjual AS pjl  
	JOIN pelanggan AS plg ON plg.id_pelanggan=pjl.id_pelanggan 
	JOIN detail_penjualan AS dpjl ON dpjl.id_penjualan=pjl.id_penjualan
    JOIN barang AS brg ON brg.id_barang=dpjl.id_barang
	WHERE pjl.id_penjualan=$id_penjualan";
    // $sql = "SELECT * FROM penjual WHERE id_penjualan=";

    $result = mysqli_query($conn, $sql);

    $data = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = array(
                'id_barang' => $row['id_barang'],
                'nama_barang' => $row['nama_barang'],
                'jumlah_barang' => $row['jumlah_barang'],
                'subtotal' => $row['subtotal'],
            );
        }
    } else {
        // Tangani error jika query gagal
        echo "Error: " . mysqli_error($conn);
    }

    return $data;
}
