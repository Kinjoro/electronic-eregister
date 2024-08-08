<?php
// getLaptops.php

// Include the database configuration file
include('connection.php');

// Set the content type to JSON
header('Content-Type: application/json');

try {
    // Create a new database connection
    $conn = new mysqli($host, $user, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        throw new Exception('Database connection failed: ' . $conn->connect_error);
    }

    // SQL query to fetch all laptops
    $sql = "SELECT laptopId, model, serialNumber, status, location FROM laptops";
    $result = $conn->query($sql);

    // Check if any results were returned
    if ($result->num_rows > 0) {
        $laptops = array();

        // Fetch the result rows as an associative array
        while ($row = $result->fetch_assoc()) {
            $laptops[] = $row;
        }

        // Output the laptops array as a JSON object
        echo json_encode($laptops);
    } else {
        // No laptops found
        echo json_encode(array());
    }

    // Close the database connection
    $conn->close();
} catch (Exception $e) {
    // Output the error message
    echo json_encode(array('error' => $e->getMessage()));
}
?>
