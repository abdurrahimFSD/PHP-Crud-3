<?php

$serverName = "localhost";
$username = "root";
$password = "";
$databaseName = "crud-3";

// Create Connection
$connectDatabase = mysqli_connect($serverName, $username, $password, $databaseName);

// Cek apakah sdh connect
if ($connectDatabase) {
    // echo "Koneksi Berhasil";
} else {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>