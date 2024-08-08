<?php
session_start();

// Check if username and password are correct (you'll need to implement this part)

// For demonstration, let's assume the user is authenticated
$username = $_POST['username'];

// Store the username in a session variable
$_SESSION['username'] = $username;

// Redirect user to the welcome page
header("Location: login.php");
exit();
?>
