<?php
session_start();

if (isset($_SESSION['account'])) {
    $userid = $_SESSION['account'];
    $conn = mysqli_connect("localhost", "root", "", "studentdb");
    $sql = "SELECT name FROM students WHERE id = '$userid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $registration_number = $row['registration_number'];
    echo "Welcome, " . $registration_number . "!";
} else {
    header("Location: dashboard.php ");
    exit();
}
?>