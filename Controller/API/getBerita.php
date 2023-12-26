<?php
include('../../Controller/Config/Connection.php');

// Ambil data berita yang sudah diverifikasi dari database
$queryBerita = "SELECT * FROM articles WHERE status_publikasi = 'DIPUBLIKASI'";
$resultBerita = $conn->query($queryBerita);

// Format data berita
$dataBerita = array();

while ($row = $resultBerita->fetch_assoc()) {
    $dataBerita[] = array(
        'nomer_artikel' => $row['nomer_artikel'],
        'judul' => $row['title'],
        'tanggal' => $row['timestamp'],
        'oleh' => $row['oleh'],
        'isi_berita' => $row['content']
        // ... tambahkan atribut berita lainnya yang diperlukan
    );
}

// Keluarkan data dalam format JSON
header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
echo json_encode($dataBerita);
?>
