<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentdb";

// Check connections
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}

// Set character set to utf8
$conn->set_charset("utf8");

// Function to login a library admin
function loginAdmin($school_email, $password, $conn) {
    global $conn;

    $sql = "SELECT * FROM admins WHERE school_email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $school_email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['admin_logged_in'] = true;
        echo "<script>window.location.href = 'admin_dashboard.php';</script>";
    } else {
        echo "Invalid username or password";
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $school_email = $_POST["school_email"];
    $password = $_POST["password"];
    loginAdmin($school_email, $password,$conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://kit.fontawesome.com/b99e675b6e.js" ></script>
    <link rel="stylesheet" href="sidebar_style.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }
        form {
            width: 720px;
            height: 400px;
            padding: 20px;
            background-color: #f1f1f1;
            border-radius: 25px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        label {
            display: block;s
            margin-bottom: 10px;
            
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 2px solid #ccc;
            border-radius: 25px;
            transition: border-color 0.3s ease-in-out;
            outline: none;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 25px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
        @media screen and (max-width: 600px) {
            form {
                width: 100%;
            }
        }
        \end{code}
    </style>
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
        <label for="school_email">Username/School Email:</label><br>
        <input type="text" id="school_email" name="school_email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <div id="ajax-loading-gif-1.gif" style="display: none;"></div>
    <script>
    const usernameInput = document.getElementById('school_email');
    const passwordInput = document.getElementById('password');
    const loadingGif = document.getElementById('ajax-loading-gif-1.gif');
    const loginButton = document.getElementById('login-button'); // Add this line

    // Add event listener to login button
    // Add event listener to login button
loginButton.addEventListener('click', (e) => {
    e.preventDefault();
    validateForm();
});

// Validate form function
function validateForm() {
    // Registration number validation
    if (usernameInput.value.trim() === '') {
        alert('Please enter your school email');
        usernameInput.focus();
        return;
    }

    // Password validation
    if (passwordInput.value.trim() === '') {
        alert('Please enter a password');
        passwordInput.focus();
        return;
    }

    // Show loading GIF
    loadingGif.style.display = 'block';

    // Submit form data to server using Fetch API
    fetch('/dashboard', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            username: usernameInput.value,
            password: passwordInput.value,
        }),
    })
    .then((response) => response.json())
    .then((data) => {
        console.log(data);
        // Hide loading GIF
        loadingGif.style.display = 'none';
        // Display success message or redirect to next page
        alert('Login successful!');
        // window.location.href = '/next-page';
    })
    .catch((error) => {
        console.error(error);
        // Hide loading GIF
        loadingGif.style.display = 'none';
        // Display error message
        alert('Error signing up. Please try again.');
    });
}
</script>
</body>
</html>