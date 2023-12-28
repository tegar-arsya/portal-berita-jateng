<?php
session_start();
require '../../Controller/Config/Connection.php';

// Fungsi untuk memverifikasi token CSRF
function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && verify_csrf_token($_POST['csrf_token'])) {
    // Ambil data dari formulir
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query untuk mendapatkan data user berdasarkan email
    $stmt = $conn->prepare("SELECT id, nama, email, password FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Memeriksa apakah ada user dengan email tersebut
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nama, $db_email, $db_password);
        $stmt->fetch();

        // Memeriksa kecocokan password
        if (password_verify($password, $db_password)) {
            // Login berhasil, buat sesi dan redirect ke halaman yang diinginkan
            $_SESSION['id'] = $id;
            $_SESSION['nama'] = $nama;

            header("Location: ../../View/Users/Home.php");
            exit();
        } else {
            // Password tidak cocok
            echo "Invalid password";
        }
    } else {
        // User tidak ditemukan
        echo "User not found";
    }

    // Menutup pernyataan dan koneksi database
    $stmt->close();
    $conn->close();
} else {
    // Token CSRF tidak valid, tanggapi sesuai kebijakan keamanan Anda
    echo "Invalid CSRF token";
}
?>
