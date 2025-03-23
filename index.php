<?php
session_start();

// If user is not logged in, redirect to login page
if (!isset($_SESSION['secret_code'])) {
    header('Location: login.php');
    exit;
}

$secretCode = $_SESSION['secret_code'];

// Fetch files from the uploads directory
$directory = 'uploads/';
$files = array_diff(scandir($directory), array('..', '.'));  // Exclude . and ..

// Filter files to only show those associated with the user's secret code
$userFiles = array_filter($files, function ($file) use ($secretCode) {
    return strpos($file, $secretCode) !== false;
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FileDorado</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Function to copy secret code to clipboard
        function copySecretCode() {
            var secretCode = document.getElementById('secretCodeFull').innerText;
            var textArea = document.createElement('textarea');
            textArea.value = secretCode;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            alert('Secret Code Copied!');
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>FileDorado</h1>
        <div style="font-size: 14px; color: #666; text-align: center;">
        <p><em><strong>Note: Be sure to copy the secret code by clicking the 'Copy Secret Code' button before leaving the website. This code will allow you to access your files from any device.</strong></em></p>
    
    </div>

        <div style="display: flex; justify-content: space-between; align-items: center;">
    <!-- Displaying the secret code -->
    <center><p><strong>Welcome, User!</strong></p></center>
    <span id="secretCodeFull" style="display:none;"><?= $secretCode; ?></span>
    
    <!-- Copy Secret Code Button -->
    <button id="copySecretCodeBtn" onclick="copySecretCode()" 
        style="padding: 5px 10px; font-size: 12px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer;">
        Copy Secret Code
    </button>

</div>


<!-- File Upload Form -->
<form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file" required>
            <button type="submit">Upload File</button>
        </form>
        <h2>Your Files</h2>
        <ul>
            <?php
            if (empty($userFiles)) {
                echo '<li>No files found.</li>';
            } else {
                foreach ($userFiles as $file) {
                    echo '<li>';
                    echo $file; // Display the file name
                    echo ' <a href="download.php?file=' . urlencode($file) . '" class="download-btn">Download</a>';
                    echo '</li>';
                }
            }
            ?>
        </ul>

        <!-- Log out link -->
        <a href="logout.php">Log out</a>
    </div>
</body>
</html>
