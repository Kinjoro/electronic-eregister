<?php
session_start();

// Database connection
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'studentdb';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}

// Set character set to utf8
$conn->set_charset("utf8");

// Function to close connection
function close_connection()
{
    global $conn;
    $conn->close();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registration_number = $_POST["registration_number"];
    $school_email = $_POST["school_email"];
    $password = $_POST["password"]; // Hash the password
    $confirm_password = $_POST["confirm_password"]; // Hash the confirm password

    // Check if password and confirm password match
    if ($_POST["password"] !== $_POST["confirm_password"]) {
        echo "Error: Password and confirm password do not match.";
        exit;
    }

    // Prepare an SQL statement to insert data into the students table
    $sql = "INSERT INTO students (registration_number, school_email, password, confirm_password) VALUES (?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters to the prepared statement
        $stmt->bind_param("ssss", $registration_number, $school_email, $password, $confirm_password);

        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "New student record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    close_connection();
}
?>