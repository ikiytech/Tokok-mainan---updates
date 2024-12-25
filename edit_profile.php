<?php
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Proses pembaruan data profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'db_connection.php';
    
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $location = $_POST['location'];  // Lokasi (Alamat)
    $phone = $_POST['phone'];        // Nomor telepon
    
    // Update query untuk menyertakan data lokasi (alamat) dan telepon
    $query = "UPDATE users SET name = ?, email = ?, location = ?, phone = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $name, $email, $location, $phone, $user_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully'); window.location.href = 'profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile');</script>";
    }
}

// Ambil data pengguna dari database
require_once 'db_connection.php'; // Pastikan ini sesuai dengan konfigurasi DB Anda
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();  // Mendapatkan data pengguna termasuk lokasi dan telepon
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Toko Mainan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Form untuk Edit Profil -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Profile</h2>
    <form action="edit_profile.php" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <!-- Kolom Alamat (Location) -->
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($user['location']); ?>" required>
        </div>
        <!-- Kolom Telepon (Phone) -->
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
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
