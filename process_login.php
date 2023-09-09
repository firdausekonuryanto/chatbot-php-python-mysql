<?php
session_start();
include 'koneksi.php';

// Mengambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk memeriksa apakah pengguna ada di database
$query = "SELECT * FROM tabel_pengguna WHERE username = '$username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];

    // Memeriksa apakah password sesuai dengan MD5
    if (md5($password) === $hashed_password) {
        // Login berhasil, redirect ke halaman utama atau dashboard
        $_SESSION['username'] = $username; // Save the username in a session variable
        header("Location: index.php");
    } else {
        // Password salah
        echo "Login gagal. Password salah.";
    }
} else {
    // Pengguna tidak ditemukan
    echo "Login gagal. Pengguna tidak ditemukan.";
}

// Tutup koneksi database
$conn->close();
?>
