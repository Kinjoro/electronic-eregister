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
ob_start();


// Check if student is logged in
if (!isset($_SESSION['student_id'])) {
    // Student is not logged in, redirect to login page
    header("location: login.php");
    exit();
}

// Get role of the student
session_start();
$role = $_SESSION['role'];


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

// Get student information
$student_id = $_SESSION['student_id'];
$student_query = "SELECT * FROM students WHERE id = '$student_id'";
$student_result = $conn->query($student_query);
$student_row = $student_result->fetch_assoc();

// Display welcome message and student information
echo "<p>Welcome, " . $student_row['registration_number'] . "!</p>";
echo "<p>Student ID: " . $student_row['id'] . "</p>";
echo "<p>Email: " . $student_row['school_email'] . "</p>";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $laptop_serial_number = $_POST["laptop_serial_number"];
    $laptop_model = $_POST["laptop_model"];
    $laptop_name = $_POST["laptop_name"];

    // Check if laptop already exists
    $laptop_query = "SELECT * FROM laptops WHERE laptop_serial_number = '$laptop_serial_number'";
    $laptop_result = $conn->query($laptop_query);

    if ($laptop_result->num_rows > 0) {
        echo "Laptop already registered.";
    } else {
        // Insert new laptop record
        $laptop_insert_query = "INSERT INTO laptops (laptop_serial_number, laptop_model, laptop_name) VALUES ('$laptop_serial_number', '$laptop_model', '$laptop_name')";
        $conn->query($laptop_insert_query);

        echo "Laptop registered successfully.";
    }
}

// Retrieve all laptops
$laptop_query = "SELECT * FROM laptops";
$laptop_result = $conn->query($laptop_query);

?>

<html>
<head>
    <title>Laptop Registration System</title>
</head>
<body>
    <h1>Laptop Registration System</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="laptop_serial_number">Laptop Serial Number:</label>
        <input type="text" name="laptop_serial_number" required>
        <br><br>
        <label for="laptop_model">Laptop Model:</label>
        <input type="text" name="laptop_model" required>
        <br><br>
        <label for="laptop_name">Laptop Name:</label>
        <input type="text" name="laptop_name" required>
        <br><br>
        <input type="submit" value="Register Laptop">
    </form>

    <h2>Registered Laptops:</h2>
    <table border="1">
        <tr>
            <th>Serial Number</th>
            <th>Model</th>
            <th>Name</th>
        </tr>
        <?php
        while ($laptop_row = $laptop_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $laptop_row["laptop_serial_number"] . "</td>";
            echo "<td>" . $laptop_row["laptop_model"] . "</td>";
            echo "<td>" . $laptop_row["laptop_name"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
ob_end_flush();
$conn->close();
?>
  <?php
  include 'authenticate_laptop.php'; 
  ?>
  <?php
include'footer.php';
 ?>
</div>

                  </div>
                  
            </div>
        </div>
    </div>
  </div>
  </div> 
  </body>
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


