<?php
session_start();
session_destroy(); // Destroy the session to log the user out
header('Location: login.php'); // Redirect to login page
exit;
?>
