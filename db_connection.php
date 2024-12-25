<?php
$host = 'localhost'; // Host database
$user = 'root';      // Username database (default XAMPP)
$password = '';      // Password database (default kosong untuk XAMPP)
$database = 'db_toko_mainan'; // Nama database Anda

$conn = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
?>
