<?php
require '../../Controller/Config/Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifikasi token CSRF
    if (!verify_csrf_token($_POST['csrf_token'])) {
        echo "<script>alert('Invalid CSRF token.');</script>";
        echo "<script>window.location.href = '../../View/Admin/login.php';</script>";
        exit();
    }

    // Ambil data dari formulir
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query untuk mendapatkan data admin berdasarkan email
    $stmt = $conn->prepare("SELECT id, nama, email, password FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Memeriksa apakah ada admin dengan email tersebut
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nama, $db_email, $db_password);
        $stmt->fetch();

        // Memeriksa kecocokan password
        if (password_verify($password, $db_password)) {
            // Login berhasil, buat sesi dan redirect ke halaman dashboard admin
            $_SESSION['id'] = $id;
            $_SESSION['nama'] = $nama;

            header("Location: ../../View/Admin/Dashboard.php");
            exit();
        } else {
            // Password tidak cocok
            echo "<script>alert('Invalid password.');</script>";
            echo "<script>window.location.href = '../../View/Admin/login.php';</script>";
        }
    } else {
        // Admin tidak ditemukan
        echo "<script>alert('Admin not found.');</script>";
        echo "<script>window.location.href = '../../View/Admin/login.php';</script>";
    }

    // Menutup pernyataan dan koneksi database
    $stmt->close();
    $conn->close();
}
?>
