<?php
$uploadDirectory = '../../Assets/User-img/';

if (isset($_FILES['upload']) && $_FILES['upload']['error'] == UPLOAD_ERR_OK) {
    $tempName = $_FILES['upload']['tmp_name'];
    $fileName = $_FILES['upload']['name'];
    $filePath = $uploadDirectory . $fileName;

    // Move the uploaded file to the desired location
    move_uploaded_file($tempName, $filePath);

    // Return the URL to CKEditor
    echo json_encode(['uploaded' => 1, 'url' => $filePath]);
} else {
    echo json_encode(['uploaded' => 0, 'error' => ['message' => 'Failed to upload']]);
}
?>