<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require '../../../Controller/Config/Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $judul = $_POST["judul"];
    $tanggal = $_POST["tanggal"];
    $oleh = $_POST["oleh"];
    $naskah = $_POST["naskah"]; // Ini akan berisi HTML dari CKEditor
    $user_id = $_SESSION['id'];

    // Contoh cara menyimpan data ke database
    $stmt = $conn->prepare("INSERT INTO articles (title, oleh, content,user_id, tanggal_masuk) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $judul, $oleh, $naskah,$user_id,  $tanggal);


    if ($stmt->execute()) {
        // Berita berhasil ditambahkan, redirect ke halaman daftar berita
        header("Location: ../../../View/Users/kelolaBerita.php");
        exit();
    } else {
        // Gagal menyimpan berita
        echo "Error: " . $stmt->error;
    }

    // Menutup pernyataan dan koneksi database
    $stmt->close();
    $conn->close();
}
?>