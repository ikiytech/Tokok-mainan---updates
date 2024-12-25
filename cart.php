<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart - Toko Mainan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Top Bar -->
    <div class="bg-light py-2">
        <div class="container d-flex justify-content-between">
            <div>
                <a href="login.html" class="me-3 text-decoration-none">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
                <a href="register.html" class="text-decoration-none">
                    <i class="bi bi-pencil-square"></i> Register
                </a>
            </div>
            <div>
                <a href="cart.html" class="text-decoration-none">
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
                        <a class="nav-link" href="#">Halaman Depan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cara Beli</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Konfirmasi Pembayaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak Kami</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Cart Section -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">My Cart</h2>
        <div id="cart-container" class="row">
            <!-- Cart items will be dynamically added here -->
        </div>
        <div class="text-end mt-4">
            <h4>Total: <span id="total-price">Rp 0</span></h4>
            <a href="checkout.html" class="btn btn-success">Proceed to Checkout</a>
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

    <!-- Script to manage cart functionality -->
    <script>
        // Update the cart count
        function updateCartCount() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            document.getElementById('cart-count').textContent = cart.length;
        }

        // Display cart items
        function displayCartItems() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const cartContainer = document.getElementById('cart-container');
            cartContainer.innerHTML = ''; // Clear the cart container

            let total = 0;

            // Check if cart is empty
            if (cart.length === 0) {
                cartContainer.innerHTML = '<p class="text-center">Your cart is empty.</p>';
                return;
            }

            // Loop through cart items and display them
            cart.forEach((item, index) => {
                const itemTotalPrice = parseFloat(item.price.replace('Rp ', '').replace('.', '').replace(',', '.')) * item.quantity;
                total += itemTotalPrice;

                const cartItemHTML = `
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="${item.img}" class="card-img-top" alt="${item.name}">
                            <div class="card-body">
                                <h5 class="card-title">${item.name}</h5>
                                <p class="card-text">${item.price}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p>Quantity: <input type="number" class="form-control" value="${item.quantity}" onchange="updateQuantity(${index}, this.value)" min="1" style="width: 80px;"></p>
                                    <button class="btn btn-danger" onclick="removeFromCart(${index})">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                cartContainer.innerHTML += cartItemHTML;
            });

            // Update total price
            document.getElementById('total-price').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Update item quantity
        function updateQuantity(index, quantity) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart[index].quantity = parseInt(quantity);
            localStorage.setItem('cart', JSON.stringify(cart));

            updateCartCount();
            displayCartItems(); // Re-render cart after update
        }

        // Add item to cart
        function addToCart(productName, productPrice, productImg) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let product = cart.find(item => item.name === productName);

            if (product) {
                product.quantity += 1;
            } else {
                cart.push({name: productName, price: productPrice, img: productImg, quantity: 1});
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
        }

        // Remove item from cart
        function removeFromCart(index) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));

            updateCartCount();
            displayCartItems(); // Re-render cart after removal
        }

        // Initialize the page
        window.onload = function() {
            updateCartCount();
            displayCartItems();
        }
    </script>
</body>
</html>
