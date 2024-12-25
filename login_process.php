<?php
// Mulai session
session_start();
require 'db_connection.php'; // Hubungkan ke database

// Pastikan request menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.html?error=' . urlencode('Akses tidak diizinkan.'));
    exit();
}

// Ambil data dari form
$email = trim($_POST['email']);
$password = $_POST['password'];

// Validasi input kosong
if (empty($email) || empty($password)) {
    header('Location: login.html?error=' . urlencode('Email dan password wajib diisi.'));
    exit();
}

// Periksa email di database
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    header('Location: login.html?error=' . urlencode('Kesalahan sistem. Coba lagi nanti.'));
    exit();
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verifikasi password
    if (password_verify($password, $user['password'])) {
        // Simpan informasi ke session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: dashboard.html'); // Redirect ke dashboard
        exit();
    } else {
        header('Location: login.html?error=' . urlencode('Password salah.'));
        exit();
    }
} else {
    header('Location: login.html?error=' . urlencode('Email tidak ditemukan.'));
    exit();
}

// Tutup koneksi
$stmt->close();
$conn->close();
