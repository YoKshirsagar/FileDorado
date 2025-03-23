<?php
session_start();

// Check if a file is specified and the user is logged in
if (isset($_GET['file']) && isset($_SESSION['secret_code'])) {
    $secretCode = $_SESSION['secret_code'];
    $file = $_GET['file'];
    $filePath = 'uploads/' . $file;

    // Check if the file exists and belongs to the user by checking the secret code in the filename
    if (file_exists($filePath) && strpos($file, $secretCode) !== false) {
        // Set headers for file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));
        header('Pragma: public');
        flush(); // Flush system output buffer
        readfile($filePath); // Output the file content
        exit;
    } else {
        echo "You do not have permission to download this file.";
    }
}
?>
