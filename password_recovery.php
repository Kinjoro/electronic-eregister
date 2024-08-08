<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'school_database';

// Connect to database
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Function to validate email
function validate_email($email) {
    $email_regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    if (!preg_match($email_regex, $email)) {
        return false;
    }
    return true;
}

// Function to generate token
function generate_token() {
    $token = bin2hex(random_bytes(16));
    return $token;
}

// Check if email and token are valid
if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];
    if (validate_email($email)) {
        $query = "SELECT * FROM students WHERE email = '$email'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $student_data = $result->fetch_assoc();
            if ($student_data['token'] == $token) {
                // Display password recovery form
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" required><br><br>
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required><br><br>
                    <input type="submit" name="reset_password" value="Reset Password">
                </form>
                <?php
            } else {
                echo "Invalid token.";
            }
        } else {
            echo "Email not found in our database.";
        }
    } else {
        echo "Invalid email format.";
    }
}

// Reset password
if (isset($_POST['reset_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    if ($new_password == $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "UPDATE students SET password = '$hashed_password' WHERE email = '$email'";
        $conn->query($query);
        echo "Password reset successfully!";
    } else {
        echo "Passwords do not match.";
    }
}

$conn->close();
?>