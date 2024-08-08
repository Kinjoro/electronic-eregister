<?php
// Configuration
$dbhost = "localhost";
$dbname = "studentdb";
$dbuser = "root";
$dbpass = "";

session_start();

// Login form submission
if (isset($_POST['registration_mumber']) && isset($_POST['password'])) {
  $registration_mumber = $_POST['registration_mumber'];
  $password = $_POST['password'];

  // Validate credentials against database
  $query = "SELECT * FROM students WHERE registration_mumber = '$registration_mumber' AND password = '$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);
    $_SESSION['registration_mumber'] = $registration_mumber;
    $_SESSION['user_id'] = $user_data['id'];session_start();

// Login form submission
if (isset($_POST['registration_mumber']) && isset($_POST['password'])) {
  $registration_mumber = $_POST['registration_mumber'];
  $password = $_POST['password'];

  // Validate credentials against database
  $query = "SELECT * FROM students WHERE registration_mumber = '$registration_mumber' AND password = '$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $user_data['id'];
    $_SESSION['role'] = $user_data['role'];

    header('Location: dashboard.php');
    exit;
  } else {
    $error = 'Invalid registration_mumber or password';
  }
}
    $_SESSION['role'] = $user_data['role'];

    header('Location: dashboard.php');
    exit;
  } else {
    $error = 'Invalid username or password';
  }
}

// Create connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: ". $conn->connect_error);
}

// Get student ID from session
$student_id = $_SESSION['student_id'];

// Enter library
if (isset($_GET['enter'])) {
  $timestamp = date("Y-m-d H:i:s");
  $query = "INSERT INTO library_log (student_id, timestamp, action) VALUES ('$student_id', '$timestamp', 'enter')";
  $conn->query($query);
  echo "You have entered the library at $timestamp";
}

// Exit library
if (isset($_GET['exit'])) {
  $timestamp = date("Y-m-d H:i:s");
  $query = "INSERT INTO library_log (student_id, timestamp, action) VALUES ('$student_id', '$timestamp', 'exit')";
  $conn->query($query);
  echo "You have exited the library at $timestamp";
}

// Close connection
$conn->close();
?>

<!-- HTML -->
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #95191c;
  }

 .timestamp {
    position: center;
    width: 50%;
    margin: 20px auto;
    padding: 40px;
    background-color: #666363;
    color: #000;
    border: 1px solid #ddd;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

 .timestamp label {
    display: block;
    margin-bottom: 10px;
  }

 .timestamp input {
    width: 50%;
    padding: 40px;
    margin-bottom: 20px;
    border: 10px solid #ccc;
  }

 .timestamp input[type="submit"] {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

 .timestamp input[type="submit"]:hover {
    background-color: #3e8e41;
  }

 .error {
    color: #red;
    font-size: 12px;
    margin-bottom: 10px;
  }

 .success {
    color: #green;
    font-size: 12px;
    margin-bottom: 10px;
  }
</style>
 <div class="timestamp">
<a href="?enter">Enter Library</a>
<a href="?exit">Exit Library</a>
</div>
<?php 
include
 'footer.php';
 ?>