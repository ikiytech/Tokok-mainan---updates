<?php 
session_start();  // Pastikan sesi dimulai di bagian atas
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Beli - Toko Mainan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Top Bar -->
    <div class="bg-light py-2">
        <div class="container d-flex justify-content-between">
            <div>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Jika sudah login -->
                    <a href="profile.php" class="me-3 text-decoration-none">
                        <i class="bi bi-person-circle"></i> My Account
                    </a>
                    <a href="logout.php" class="text-decoration-none">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                <?php else: ?>
                    <!-- Jika belum login -->
                    <a href="login.php" class="me-3 text-decoration-none">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                    <a href="register.php" class="text-decoration-none">
                        <i class="bi bi-pencil-square"></i> Register
                    </a>
                <?php endif; ?>
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
            <a class="navbar-brand" href="index.php">Toko Mainan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Halaman Depan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="carabeli.php">Cara Beli</a>
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
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Cara Beli Section -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Cara Beli</h2>
        <div class="card p-4 shadow-sm">
            <ol class="list-group list-group-numbered">
                <li class="list-group-item">
                    <strong>Pilih Produk:</strong> Jelajahi katalog produk melalui kategori atau menggunakan fitur pencarian di atas.
                </li>
                <li class="list-group-item">
                    <strong>Tambahkan ke Keranjang:</strong> Klik tombol "Tambahkan ke Keranjang" untuk menyimpan produk pilihan Anda.
                </li>
                <li class="list-group-item">
                    <strong>Lakukan Pembayaran:</strong> Setelah memilih produk, buka keranjang belanja, lalu pilih metode pembayaran yang Anda inginkan.
                </li>
                <li class="list-group-item">
                    <strong>Konfirmasi Pemesanan:</strong> Anda akan menerima email konfirmasi setelah pembayaran berhasil.
                </li>
            </ol>
        </div>

        <!-- FAQ Section -->
        <div class="mt-5">
            <h3 class="mb-3">Pertanyaan Umum</h3>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Apakah pembayaran aman?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="faqOne">
                        <div class="accordion-body">
                            Ya, kami menggunakan sistem pembayaran yang terenkripsi untuk melindungi data Anda.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Apa saja metode pembayaran yang tersedia?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo">
                        <div class="accordion-body">
                            Kami menerima transfer bank, kartu kredit, dan e-wallet.
                        </div>
                    </div>
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
</body>
</html>
