<?php
include 'connection.php';
?>

<?php
// Function to validate the format of the serial number (this is just an example)
function isValidSerialNumber($serial) {
    // Define your serial number format (example: alphanumeric, length 9-12)
    return preg_match('/^[A-Z0-9]{9,12}$/', $serial);
}

// Get the serial number from the request (e.g., form input or query parameter)
$serialNumber = $_GET['laptop_serial_number'] ?? '';

if (empty($serialNumber)) {
    echo "Serial number is required.";
    exit;
}

if (!isValidSerialNumber($serialNumber)) {
    echo "Invalid serial number format.";
    exit;
}

// Prepare and bind
$stmt = $conn->prepare("SELECT laptop_serial_number FROM laptopss WHERE laptop_serial_number = ?");
$stmt->bind_param("s", $serialNumber);

// Execute the query
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "The serial number exists, is valid, and is real.";
} else {
    echo "The serial number does not exist.";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
