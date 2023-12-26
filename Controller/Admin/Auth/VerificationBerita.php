<?php
session_start();
include('../../../Controller/Config/Connection.php');

if (!isset($_SESSION['id'])) {
    header("Location: ../../../View/Admin/login.php");
    exit();
}

$user_admin = $_SESSION['id'];

if (!isset($_POST['nomer_artikel'])) {
    // Redirect ke halaman lain atau tampilkan pesan error jika tidak ada nomer artikel
    header("Location: ../../../View/Admin/halaman_error.php");
    exit();
}

$nomer_artikel = $_POST['nomer_artikel'];

// Query untuk melakukan verifikasi
$queryVerifikasi = "UPDATE articles SET status_verifikasi = 'TERVERIFIKASI' WHERE nomer_artikel = '$nomer_artikel'";
$resultVerifikasi = $conn->query($queryVerifikasi);

if ($resultVerifikasi) {
    // Query untuk melakukan publikasi setelah verifikasi sukses
    $queryPublikasi = "UPDATE articles SET status_publikasi = 'DIPUBLIKASI' WHERE nomer_artikel = '$nomer_artikel'";
    $resultPublikasi = $conn->query($queryPublikasi);

    if ($resultPublikasi) {
        // Redirect ke halaman sukses verifikasi dan publikasi
        header("Location: ../../../View/Admin/daftarBerita.php");
        exit();
    } else {
        // Redirect ke halaman gagal publikasi
        header("Location: ../../../View/Admin/halaman_gagal_publikasi.php");
        exit();
    }
} else {
    // Redirect ke halaman gagal verifikasi
    header("Location: ../../../View/Admin/halaman_gagal_verifikasi.php");
    exit();
}
?>
