<?php
session_start();

// Check if a file is uploaded and the user is logged in
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']) && isset($_SESSION['secret_code'])) {
    $secretCode = $_SESSION['secret_code'];
    $targetDir = 'uploads/';
    $fileName = basename($_FILES['file']['name']);
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    // Append the secret code to the filename
    $newFileName = $secretCode . '_' . time() . '.' . $fileExtension; // Unique filename with secret code
    $targetFile = $targetDir . $newFileName;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        echo "The file has been uploaded successfully.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    // Redirect to the index page after upload (to show the updated file list)
    header('Location: index.php');
    exit;
}
?>
