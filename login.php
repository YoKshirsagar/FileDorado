<?php
session_start();

// If the user is already logged in (has a secret code), redirect them to index
if (isset($_SESSION['secret_code'])) {
    header('Location: index.php');
    exit;
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['generate_code'])) {
        // Generate a unique secret code (you can customize this part)
        $secretCode = bin2hex(random_bytes(8)); // Generates a 16-character hex code
        $_SESSION['secret_code'] = $secretCode; // Store secret code in session
        header('Location: index.php'); // Redirect to index page after generation
        exit;
    }

    if (isset($_POST['join_code'])) {
        // Get the secret code from the form
        $enteredCode = $_POST['secret_code'];

        // In a real application, you would check if this code exists in a database
        // For simplicity, we assume all codes are valid
        $_SESSION['secret_code'] = $enteredCode; // Store the entered secret code
        header('Location: index.php'); // Redirect to index page after successful login
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | User File Management</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
        <h1>User File Management</h1>

        <?php if (isset($message)) : ?>
            <p class="message"><?= htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <div class="login-cards">
            <!-- Option 1: Generate Secret Code -->
            <div class="login-card">
                <h2>Generate Secret Code</h2>
                <form action="login.php" method="POST">
                    <button type="submit" name="generate_code">Generate Secret Code</button>
                </form>
            </div>

            <!-- Option 2: Join Through Existing Secret Code -->
            <div class="login-card">
                <h2>Join Through Secret Code</h2>
                <form action="login.php" method="POST">
                    <input type="text" name="secret_code" placeholder="Enter your secret code" required>
                    <button type="submit" name="join_code">Join</button>
                </form>
            </div>
        </div>

        <!-- Important Note Section -->
        <div class="note-section">
            <p><strong>Note:</strong> You can either generate your own secret code or simply create one by entering any combination in the "Enter your Secret Code" section. Just remember, it's important to keep your code confidential.</p>
        </div>
    </div>
</body>
</html>
