<?php

$servername = "localhost";
$database = "kasir";
$username = "root";
$password = "";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());
}


// $conn = mysqli_connect("localhost", "root", "", "kasir");
// if($conn) {
//     die("Eror koneksi ke database");
// }
