<?php
session_start();

// Daftar user valid (contoh)
$users = [
    'admin' => '12345',
];

// Ambil input dari form
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// Cek kalau ada field kosong (biar nggak muncul error)
if ($username === '' || $password === '') {
    // Kembali ke form tanpa pesan apa-apa
    header("Location: login_form.php");
    exit;
}

// Cek apakah username dan password cocok
if (array_key_exists($username, $users) && $users[$username] === $password) {
    // Login sukses
    $_SESSION['username'] = $username;
    header("Location: dashboard.php");
    exit;
} else {
    // Login gagal → kirim pesan error
    header("Location: login_form.php?err=" . urlencode('Username atau password salah.'));
    exit;
}
?>
