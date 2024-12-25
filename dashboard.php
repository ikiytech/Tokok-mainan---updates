<?php
// Memulai session
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html'); // Redirect ke halaman login jika belum login
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Toko Mainan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .card-img-top:hover {
            transform: scale(1.1);
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 200px;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .btn-primary {
            flex-grow: 1;
            margin-right: 10px;
        }

        .btn-success {
            flex-grow: 1;
        }
    </style>
</head>

<body>
    <!-- Top Bar -->
    <div class="bg-light py-2">
        <div class="container d-flex justify-content-between">
            <div>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="profile.php" class="me-3 text-decoration-none">My Account</a>
                    <a href="logout.php" class="text-decoration-none">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="me-3 text-decoration-none">Login</a>
                    <a href="register.php" class="text-decoration-none">Register</a>
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
            <a class="navbar-brand" href="#">Toko Mainan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Halaman Depan</a></li>
                    <li class="nav-item"><a class="nav-link" href="carabeli.php">Cara Beli</a></li>
                    <li class="nav-item"><a class="nav-link" href="faq.php">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="konfirmasi.php">Konfirmasi Pembayaran</a></li>
                    <li class="nav-item"><a class="nav-link" href="kontak.php">Kontak Kami</a></li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- New Arrival Section -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">New Arrival</h2>
        <div class="row" id="product-container">
            <!-- Produk akan ditampilkan di sini oleh JavaScript -->
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="text-center p-3">&copy; 2024 Toko Mainan. All Rights Reserved.</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

    <!-- Script untuk menampilkan produk secara acak dan menambahkan ke keranjang -->
    <script>
        const products = [
            {name: "Mainan Topeng Helm Dinosaurus Mask Helmet Dino", price: "Rp 250.000", img: "assets/images/TOPENG.jpg", waLink: "https://wa.me/6281234567890?text=Saya%20ingin%20membeli%20Mainan%20Aksi%20Super"},
            {name: "Mainan Anak Celengan ATM Crab Piggy Bank Tabungan", price: "Rp 125.000", img: "assets/images/Celengan ATM.jpg", waLink: "https://wa.me/6281234567890?text=Saya%20ingin%20membeli%20Puzzle%20Edukasi"},
            {name: "Mainan Pistol Soft Blaster Foam Shooter", price: "Rp 65.000", img: "assets/images/Tomindo Mainan.jpg", waLink: "https://wa.me/6281234567890?text=Saya%20ingin%20membeli%20Mainan%20Balok%20Kreatif"},
            {name: "Uno stacko", price: "Rp 80.000", img: "assets/images/p1.png", waLink: "https://wa.me/6281234567890?text=Saya%20ingin%20membeli%20Boneka%20Lucu"},
            {name: "Mainan Truk Besar", price: "Rp 250.000", img: "assets/images/p2.png", waLink: "https://wa.me/6281234567890?text=Saya%20ingin%20membeli%20Mainan%20Kendaraan%20Roda"},
            {name: "Mainan teka teki", price: "Rp 300.000", img: "assets/images/p3.png", waLink: "https://wa.me/6281234567890?text=Saya%20ingin%20membeli%20Figur%20Aksi%20Hulk"},
            {name: "Mainan Brick susun", price: "Rp 220.000", img: "assets/images/p4.png", waLink: "https://wa.me/6281234567890?text=Saya%20ingin%20membeli%20Mainan%20Truk%20Besar"},
            {name: "Lego Robot", price: "Rp 150.000", img: "assets/images/p5.png", waLink: "https://wa.me/6281234567890?text=Saya%20ingin%20membeli%20Permainan%20Papan%20Catur"},
            {name: "Mainan Robot Iron Man", price: "Rp 350.000", img: "assets/images/p6.png", waLink: "https://wa.me/6281234567890?text=Saya%20ingin%20membeli%20Mainan%20Robot%20Interaktif"},
            {name: "Boneka Candy JOR", price: "Rp 100.000", img: "assets/images/p7.png", waLink: "https://wa.me/6281234567890?text=Saya%20ingin%20membeli%20Boneka%20Teddy%20Bear"},
            {name: "Mainan Drone", price: "Rp 175.000", img: "assets/images/p8.png", waLink: "https://wa.me/6281234567890?text=Saya%20ingin%20membeli%20Mainan%20Kendaraan%20Mobil"},
            {name: "Mainan Figur Basket", price: "Rp 140.000", img: "assets/images/p9.png", waLink: "https://wa.me/6281234567890?text=Saya%20ingin%20membeli%20Puzzle%203D"},
            {name: "Mainan Play Doth", price: "Rp 90.000", img: "assets/images/p10.png", waLink: "https://wa.me/6281234567890?text=Saya%20ingin%20membeli%20Mainan%20Edukasi%20Anak"},
        ];

        // Menambahkan produk ke dalam keranjang
        function addToCart(product) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.push(product);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
        }

        // Update jumlah keranjang di topbar
        function updateCartCount() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            document.getElementById('cart-count').innerText = cart.length;
        }

        // Menampilkan produk di halaman
        function displayProducts() {
            const productContainer = document.getElementById('product-container');
            products.forEach(product => {
                const productCard = `
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="${product.img}" class="card-img-top" alt="${product.name}">
                            <div class="card-body">
                                <h5 class="card-title">${product.name}</h5>
                                <p class="card-text">${product.price}</p>
                                <div class="btn-container">
                                    <button class="btn btn-primary" onclick='addToCart(${JSON.stringify(product)})'>Tambahkan ke Keranjang</button>
                                    <a href="${product.waLink}" class="btn btn-success">Beli via WhatsApp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                productContainer.innerHTML += productCard;
            });
        }

        // Memuat produk dan memperbarui jumlah keranjang ketika halaman dimuat
        window.onload = function() {
            displayProducts();
            updateCartCount();
        };
    </script>
</body>
</html>
