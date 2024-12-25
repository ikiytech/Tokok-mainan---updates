<?php
// Memulai session
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Hubungkan ke database
require 'db_connection.php'; // Pastikan file ini ada dan benar

// Ambil data pengguna dari database
$user_id = $_SESSION['user_id'];
$sql = "SELECT name, email, phone, address, profile_picture, created_at FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);

// Cek apakah query berhasil disiapkan
if (!$stmt) {
    die('Terjadi kesalahan pada query: ' . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($name, $email, $phone, $address, $profile_picture, $created_at);
$stmt->fetch();

// Tutup koneksi
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Toko Mainan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ddd;
        }
        .btn-container {
            display: flex;
            justify-content: flex-start;
            margin-top: 1rem;
        }
        .btn-primary {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="bg-light py-2">
        <div class="container d-flex justify-content-between">
            <div>
                <a href="profile.php" class="me-3 text-decoration-none">
                    <i class="bi bi-person-circle"></i> My Account
                </a>
                <a href="logout.php" class="text-decoration-none">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
            <div>
                <a href="cart.php" class="text-decoration-none">
                    My cart <span class="badge bg-primary" id="cart-count">0</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Toko Mainan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Halaman Depan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="carabeli.php">Cara Beli</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="konfirmasi.php">Konfirmasi Pembayaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak Kami</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Section -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Profil Pengguna</h2>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <img src="<?php echo $profile_picture; ?>" alt="Profile Picture" class="profile-img mb-3">
                <h3><?php echo $name; ?></h3>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Phone:</strong> <?php echo $phone; ?></p>
                <p><strong>Address:</strong> <?php echo $address; ?></p>
                <p><strong>Member Since:</strong> <?php echo date("d F Y", strtotime($created_at)); ?></p> <!-- Menampilkan waktu pendaftaran -->

                <div class="btn-container">
                    <a href="edit_profile.php" class="btn btn-primary">Edit Profil</a>
                    <a href="change_password.php" class="btn btn-success">Ganti Password</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="text-center p-3">
            &copy; 2024 Toko Mainan. All Rights Reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

</body>
</html>
