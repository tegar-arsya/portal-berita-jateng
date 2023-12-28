<?php
require '../../Controller/Config/Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifikasi token CSRF
    if (!verify_csrf_token($_POST['csrf_token'])) {
        echo "<script>alert('Invalid CSRF token.');</script>";
        echo "<script>window.location.href = '../../index.php';</script>";
        exit();
    }

    // Mengambil data dari formulir
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Enkripsi password sebelum menyimpan ke database (gunakan metode enkripsi yang aman)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Menyiapkan statement SQL untuk menyimpan data ke database
    $stmt = $conn->prepare("INSERT INTO user (nama, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $email, $hashed_password);

    // Menjalankan pernyataan SQL
    if ($stmt->execute()) {
        // Registrasi berhasil
        header("Location: ../../index.php"); // Redirect ke halaman login
        exit();
    } else {
        // Registrasi gagal
        $error_message = "Error: " . $stmt->error;
        echo $error_message;
    }

    // Menutup statement dan koneksi database
    $stmt->close();
    $conn->close();
}
?>
