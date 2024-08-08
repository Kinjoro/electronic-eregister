<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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
                            <a href="#" class="">
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
                                <li>
                                <a href="intervalReport.php" class="">
                                <span class="icon">
                                <i class="fa-solid fa-chart-simple"></i>
     
                                </span>
                                <span class="text">Analytics</span>
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
if (isset($_GET['laptop_serial_number'])) {
    
    if ($result->num_rows > 0) {
        $_SESSION['student_id'] = $user_id;
        header('Location: checkout.php');
    } else {
        $error = "Invalid user";
    }
}               
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'studentdb';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handler
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serial_number = $_POST["laptop_serial_number"];
    $laptop_model = $_POST["laptop_model"];
    $laptop_name = $_POST["laptop_name"];

    // Check if laptop exists
    $laptop_query = "SELECT * FROM laptops WHERE laptop_serial_number = '$serial_number'";
    $laptop_result = $conn->query($laptop_query);

    if ($laptop_result->num_rows > 0) {
        $laptop_row = $laptop_result->fetch_assoc();

        // Check if laptop is already checked out
        $checkout_query = "SELECT * FROM laptop_signouts WHERE laptop_serial_number = '$serial_number' AND checkout_date IS NULL";
        $checkout_result = $conn->query($checkout_query);

        if ($checkout_result->num_rows) {
            echo "Laptop is already checked in. Please Check out first.";
        } else {
            // Insert new checkout record
            $checkout_query = "INSERT INTO laptop_signouts (laptop_serial_number, checkin_date) VALUES ('$serial_number',  NOW())";
            $conn->query($checkout_query);

            echo "Laptop checked in successfully.";
        }
    } else {
        // Laptop not found, insert new laptop records
        $laptop_insert_query = "INSERT INTO laptops (laptop_serial_number, laptop_model, laptop_name) VALUES ('$serial_number', '$laptop_model', '$laptop_name')";
        $conn->query($laptop_insert_query);

        // Insert new checkout record
        $checkout_query = "INSERT INTO laptop_signouts (laptop_serial_number,  checkin_date) VALUES ('$serial_number', NOW())";
        $conn->query($checkout_query);

        echo "Laptop signed in successfully. New laptop record created.";
    }
}

// Close connection
$conn->close();
?>

<!-- HTML Form -->
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <label for="laptop_serial_number">Serial Number:</label>
    <input type="text" id="laptop_serial_number" name="laptop_serial_number" required><br><br>
    <label for="laptop_model">Laptop Model:</label>
    <input type="text" id="laptop_model" name="laptop_model" required><br><br>
    <label for="laptop_name">Laptop Name:</label>
    <input type="text" id="laptop_name" name="laptop_name" required><br><br>
    <input type="submit" value="Check In Laptop"><br><br>

<div>
    <a href="checkout_laptop.php" style="color:dark position:center" >Check out Laptop</a>
</div>
</form>
</div>
            </div>
        </div>
    </div>
  </div>
  </div> 
  <?php 
    include 'authenticate_laptop.php';
  ?>
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

