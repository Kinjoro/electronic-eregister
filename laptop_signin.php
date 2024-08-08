<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// User Authentication Functions
function loginUser($username, $password) {
    global $conn;
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $password = md5($password); // You should use a more secure hashing algorithm

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        return true;
    } else {
        return false;
    }
}

function logoutUser() {
    session_unset();
    session_destroy();
}

// Laptop Sign-In/Sign-Out Functions
function signInLaptop($laptop_id) {
    global $conn;
    $user_id = $_SESSION['user_id'];
    $timestamp = date('Y-m-d H:i:s');
    $sql = "INSERT INTO laptop_signin (user_id, laptop_id, signin_time) VALUES ('$user_id', '$laptop_id', '$timestamp')";
    $conn->query($sql);
}

function signOutLaptop($laptop_id) {
    global $conn;
    $user_id = $_SESSION['user_id'];
    $timestamp = date('Y-m-d H:i:s');
    $sql = "UPDATE laptop_signin SET signout_time='$timestamp' WHERE user_id='$user_id' AND laptop_id='$laptop_id' AND signout_time IS NULL";
    $conn->query($sql);
}

// Sensor Integration (Assuming sensors trigger this script with laptop ID)
if (isset($_POST['laptop_id'])) {
    $laptop_id = $_POST['laptop_id'];
    $action = $_POST['action'];

    if ($action == 'signin') {
        signInLaptop($laptop_id);
    } elseif ($action == 'signout') {
        signOutLaptop($laptop_id);
    }
}

// Example usage:
// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    // Display welcome message based on user role
    $role = $_SESSION['role'];
    switch ($role) {
        case 'admin':
            echo "Welcome Admin!";
            break;
        case 'staff':
            echo "Welcome Library Staff!";
            break;
        case 'student':
            echo "Welcome Student!";
            break;
    }
} else {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}
?>
