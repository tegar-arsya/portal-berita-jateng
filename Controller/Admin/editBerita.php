<?php
session_start();
include('../../Controller/Config/Connection.php');

if (!isset($_SESSION['id'])) {
    header("Location: ../../View/Admin/Admin");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomer_artikel = $_POST['nomer_artikel'];
    $judul = $_POST['judul'];
    $isi_berita = $_POST['isi_berita'];

    // Lakukan validasi atau pengolahan data lainnya sesuai kebutuhan

    // Contoh update berita
    $stmt = $conn->prepare("UPDATE articles SET title = ?, content = ? WHERE nomer_artikel = ?");
    $stmt->bind_param("sss", $judul, $isi_berita, $nomer_artikel);

    if ($stmt->execute()) {
        // Berhasil diupdate, redirect ke halaman detail berita
        header("Location: ../../View/Admin/DaftarBerita");
        exit();
    } else {
        // Gagal update berita
        echo "Error: " . $stmt->error;
    }

    // Menutup pernyataan dan koneksi database
    $stmt->close();
    $conn->close();
} else {
    // Jika bukan metode POST, mungkin Anda ingin menangani dengan memberikan pesan atau redirect
    echo "Metode yang tidak valid";
}
?>
