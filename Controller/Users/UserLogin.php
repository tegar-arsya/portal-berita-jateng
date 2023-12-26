<?php
// Include file koneksi
require '../../Controller/Config/Connection.php';

session_start(); // Mulai sesi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
}
?>
