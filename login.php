<?php
// Mulai session
session_start();

// Koneksi ke database
require 'db_connection.php'; // File koneksi database

// Pastikan request menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.html?error=Metode permintaan tidak valid!');
    exit();
}

// Ambil data dari form
$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Validasi input kosong
if (empty($email) || empty($password)) {
    header('Location: login.html?error=Semua kolom wajib diisi!');
    exit();
}

// Periksa email di database
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die('Terjadi kesalahan pada database: ' . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Verifikasi hasil pencarian user
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verifikasi password
    if (password_verify($password, $user['password'])) {
        // Set session jika login berhasil
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: dashboard.php'); // Redirect ke dashboard.php
        exit();
    } else {
        header('Location: login.html?error=Password salah!');
        exit();
    }
} else {
    header('Location: login.html?error=Email tidak ditemukan!');
    exit();
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
