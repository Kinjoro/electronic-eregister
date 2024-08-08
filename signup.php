<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['registration_number'])) {
    $username = $_SESSION['registration_number'];
    echo "Welcome, $registration_number!";
} else {
    // Redirect user to the login page if not logged in
    header("Location: login.php");
    exit();
}
?>
