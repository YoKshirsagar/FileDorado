<?php
// Define the directory where files are uploaded
$directory = 'uploads/';

// Check if directory exists
if (!is_dir($directory)) {
    echo json_encode(["error" => "Directory not found"]);
    exit;
}

// Get all files in the directory, excluding '.' and '..'
$files = array_diff(scandir($directory), array('..', '.'));

// Debugging: print the files array
if (empty($files)) {
    echo json_encode(["error" => "No files found in the directory"]);
} else {
    echo json_encode($files);
}
?>
