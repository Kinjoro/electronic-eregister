<?php 
// Start session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Student dashboard</title>
    <script src="https://kit.fontawesome.com/b99e675b6e.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link rel="stylesheet" href="sidebar_style.css">

</head>
<body>
  <div class="wrapper">
    <div class="wrapper_inner">
        <div class="vertical_wrap" >
            <div class="backdrop"></div>
            <div class="vertical_bar" >
                <div class="profile_info" >
                    <div class="profile_image" ></div>
                    <div class="img_holder" >
                        <img src="kabulogo.png" alt="Kabu_logo" style
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                            border-radius: 50%;>
                           <p class="title">Stevoh</p>
                        <p class="sub_title">stevoh@gmail.com</p>
                    </div>  
                    <ul class="menu">
                        <li class="">
                            <a href="#" class="active">
                                <span class="icon">
                                <i class="fa-solid fa-gauge-high"></i>
                                </span>
                                
                                <span class="text">Dashboard</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#" class="">
                                <span class="icon">
                                <i class="fa-solid fa-house"></i>
                                </span>
                                <span class="text">Home</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#" class="">
                                <span class="icon">
                                <i class="fa-solid fa-laptop"></i>
     
                                </span>
                                <span class="text">Laptops</span>
                            </a>
                            <ol>
                                <li>
                                <a href="checkedin_laptop_list.php" class="">
                                <span class="icon">
                                <i class="fa-solid fa-building-circle-check"></i>
     
                                </span>
                                <span class="text">Checked in</span>
                            </a>
                                </li>
                                <li>
                                <a href="checkedout_laptop_list.php" class="">
                                <span class="icon">
                                <i class="fa-solid fa-building-circle-check"></i>
     
                                </span>
                                <span class="text">Checked out</span>
                            </a>
                                </li>
                                </ol>                                                           
                        </li>
                        <li class="">
                            <a href="#" class="">
                                <span class="icon">
                                     <i class="fa-solid fa-user-edit"></i>
                                </span>
                                <span class="text">Settings</span>
                            </a>
                        </li>
                        <ol>
                        <li>
                                <a href="intervalReport.php" class="">
                                <span class="icon">
                                <i class="fa-solid fa-chart-simple"></i>
     
                                </span>
                                <span class="text">Analytics</span>
                            </a>
                                </li>
                                <li>
                                <a href="current_student.php" class="">
                                <span class="icon">
                                <i class="fa-solid fa-building-circle-check"></i>
     
                                </span>
                                <span class="text">Current Users</span>
                            </a>
                                </li>
                                <li>
                                <a href="absent_student.php" class="">
                                <span class="icon">
                                <i class="fa-solid fa-building-circle-check"></i>
     
                                </span>
                                <span class="text">Absent Users</span>
                            </a>
                                </li>
                        </ol>
                        <li class="">
                            <a href="#" class="">
                                <span class="icon">
                                <i class="fa-solid fa-user"></i>
                                </span>
                                <span class="text">Profile</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="signup.php" class="">
                                <span class="icon">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                </span>
                                <span class="text">Logout</span>
                            </a>
                        </li>
                    </ul> 
                    <ul class="social">
                        <li><a href="#" >
                        <i class="fa-brands fa-twitter"></i>
                        </a> </li>
                        <li> <a href="#" >
                            <i class="fa-brands fa-facebook-f"></i>
                        </a> </li>
                        <li><a href="#" >
                            <i class="fa-brands fa-instagram"></i>
                        </a> </li>
                         <li> <a href="#" >
                         <i class="fa-brands fa-linkedin"></i>
                        </a> </li>
                        <li> <a href="#" >

                        </a> </li>
                    </ul>       
                </div>

                </div>
            </div>        
        <div class="main_container" >
            <div class="top_bar">
                <div class="humburger">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="logo">
                    Kinjoro <span>Developer</span>
                </div>
            </div>
            <div class="content">
                <div class="item">
                 

<?php

// Configuration
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "studentdb";

// Create connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Get student information
if (isset($_SESSION['registration_number'])) {
    $registration_number = $_SESSION['registration_number'];
    $query = "SELECT * FROM students WHERE registration_number =?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $registration_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student_info = $result->fetch_assoc();
    } else {
        echo "No student information found.";
        $student_info = array();
    }
} else {
    echo "Please login to access the dashboard.";
    $student_info = array();
}

// Close connection
$conn->close();
?>
<!-- HTML and CSS -->
<link rel="stylesheet" href="bootstrap.min.css">
<link rel="stylesheet" href="loader.css">

<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
  }

  .dashboard {
    width: 80%;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .dashboard h2 {
    margin-top: 0;
  }

  .student-info {
    margin-bottom: 20px;
  }

  .student-info label {
    display: block;
    margin-bottom: 10px;
  }

  .student-info span {
    font-weight: bold;
  }

  .footer {
    background-color: #333;
    color: #fff;
    padding: 10px;
    text-align: center;
    clear: both;
  }
</style>

<div class="dashboard">
  <h2>Student Dashboard</h2>
  <?php if (isset($student_info) && count($student_info) > 0) {?>
  <div class="student-info">
    <label>Registration Number:</label>
    <span><?= isset($student_info['registration_number'])? $student_info['registration_number'] : 'Not available'?></span><br><br>

    <label>School Email:</label>
    <span><?= isset($student_info['school_email'])? $student_info['school_email'] : 'Not available'?></span><br><br>
    <label>Phone Number:</label>
    <span><?= isset($student_info['phone_number'])? $student_info['phone_number'] : 'Not available'?></span><br><br>
  </div>
  <?php }?>
</div>

  <!-- Add more features or information here -->
  <p>Welcome to your dashboard, <?= $student_info['registration_number']?>!</p>
  <p>Now let's register your laptop <a href="#laptop_check">click here</a> </p>
  <p>Already registered your laptop checkin or out </p>

  <?php
  
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
    $_SESSION['student_id'] = $user_data['student_id'];session_start();

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
    $_SESSION['student_id'] = $user_data['student_id'];
    $_SESSION['role'] = $user_data['role'];

    header('Location: dashboard.php');
    exit;
  } else {
    $error = 'Invalid registration_mumber or password';
  }
}
    $_SESSION['role'] = $user_data['role'];

    header('Location: index.php');
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

// Enter library
if (isset($_GET['checkout'])) {
  $timestamp = date("Y-m-d H:i:s");
  $query = "INSERT INTO library_log (student_id, timestamp, action) VALUES ('$student_id', '$timestamp', 'checkout')";
  $conn->query($query);
  echo "You have checked out your laptop at $timestamp";
}

// check in laptop
if (isset($_GET['checkin'])) {
  $timestamp = date("Y-m-d H:i:s");
  $query = "INSERT INTO library_log (student_id, timestamp, action) VALUES ('$student_id', '$timestamp', 'checkin')";
  $conn->query($query);
  echo "You have checked your laptop at $timestamp";
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
  .footer
  {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #666363;
    
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
 <div class="timestamp" id="laptop_check" >
<a href="checkin_laptop.php?enter">Check In Laptop</a>
<a href="checkout_laptop.php?exit">Check Out Laptop</a>
</div>
</div>

<div class="footer">
  <p>&copy; 2024 Student Dashboard. All rights reserved.</p>
</div>
            </div>
        </div>
    </div>
  </div>
  </div> s
  </div>
  <script>
    var humburger=document.querySelector(".humburger");
    var wrapper=document.querySelector(".wrapper");
    var backdrop=document.querySelector(".backdrop");

    humburger.addEventListener("click", function(){
        wrapper.classList.add("active");
    })

    backdrop.addEventListener("click", function(){
        wrapper.classList.remove("active");
    });

  </script>
</body>
 </html>
 <?php
include'footer.php';
 ?>

