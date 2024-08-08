<?php
session_start();

if (isset($_SESSION['account'])) {
    $userid = $_SESSION['account'];
    $conn = mysqli_connect("localhost", "root", "", "studentdb");
    $sql = "SELECT name FROM admins WHERE id = '$userid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $username = $row['name'];
    echo "Welcome, " . $username . "!";
} else {
    header("Location: dashboard.php");
    exit();
}
?>