<?php
require '../../../Controller/Config/Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no = $_POST['nomer_artikel'];

    // Lakukan penghapusan data dari database berdasarkan ID
    $sql = "DELETE FROM articles WHERE nomer_artikel = '$no'";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
