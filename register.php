<?php
// Mulai session
session_start();
require 'db_connection.php'; // Hubungkan ke database

// Pastikan request menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.html?error=' . urlencode('Akses tidak diizinkan.'));
    exit();
}

// Ambil data dari form
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm-password'];

// Validasi input kosong
if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
    header('Location: register.html?error=' . urlencode('Semua kolom wajib diisi.'));
    exit();
}

// Validasi format email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: register.html?error=' . urlencode('Format email tidak valid.'));
    exit();
}

// Validasi password dan konfirmasi password
if ($password !== $confirm_password) {
    header('Location: register.html?error=' . urlencode('Password dan konfirmasi password tidak sama.'));
    exit();
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Periksa apakah email sudah digunakan
$sql_check = "SELECT * FROM users WHERE email = ?";
$stmt_check = $conn->prepare($sql_check);
if (!$stmt_check) {
    header('Location: register.html?error=' . urlencode('Kesalahan sistem. Coba lagi nanti.'));
    exit();
}

$stmt_check->bind_param("s", $email);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    $stmt_check->close();
    header('Location: register.html?error=' . urlencode('Email sudah digunakan.'));
    exit();
}
$stmt_check->close();

// Tambahkan waktu pembuatan
$created_at = date("Y-m-d H:i:s");

// Simpan data pengguna ke database
$sql = "INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    header('Location: register.html?error=' . urlencode('Kesalahan sistem. Coba lagi nanti.'));
    exit();
}

$stmt->bind_param("ssss", $name, $email, $hashed_password, $created_at);

if ($stmt->execute()) {
    // Berhasil, arahkan ke login
    header('Location: login.html?success=' . urlencode('Registrasi berhasil! Silakan login.'));
    exit();
} else {
    header('Location: register.html?error=' . urlencode('Registrasi gagal. Silakan coba lagi.'));
    exit();
}

// Tutup koneksi
$stmt->close();
$conn->close();
