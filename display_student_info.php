<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b99e675b6e.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link rel="stylesheet" href="sidebar_style.css">

</head>
<body>
  <div class="wrapper">
    <div class="wrapper_inner">
        <div class="vertical_wrap" >
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
                                     <i class="fa-solid fa-laptop"></i>
     
                                </span>
                                <span class="text">Checked in</span>
                            </a>
                                </li>
                                <li>
                                <a href="checkedout_laptop_list.php" class="">
                                <span class="icon">
                                     <i class="fa-solid fa-laptop"></i>
     
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
                <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- page content-->
<div>
    <div class="right_col" role="main">
        <div class="title_left">
            <h3>Library Management System</h3>
        </div>
    </div>
    <div class="tittle_right"></div>

        <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_serch">
            <div class="imput-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-primary">
                        Search
                    </button>
                </span>
                
        <div class="clearfix"></div>
            <div class="row" style="..." >
                <div class="col-md-12 col-sm-12 col-xs-12" >
                     <div class="x_panel" >
                         <div class="x_title" >
                             <h2>Plain Page</h2>
                                 <div class="clearfix"></div>
                                 <div class="x_content">
                                 <?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'studentdb';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Set character set to utf8
$conn->set_charset("utf8");

// Function to close connection
function close_connection() {
    global $conn;
    $conn->close();
}

// Fetch all students from the database
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

// Display students in a table
if ($result->num_rows > 0) {
    echo "<table class='table table-dark'>";
    echo "<tr>
    <th>Registration Number</th>
    <th>School Email</th>
    <th>Phone Number</th>
    <th>Role</th>
    <th>Created At</th>
    <th>Updated At</th>
    </tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["registration_number"]. "</td>
        <td>" . $row["school_email"]. "</td>
        <td>" . $row["phone_number"]. "</td>
         <td>" . $row["role"]. "</td>
          <td>" . $row["created_at"]. "</td>
           <td>" . $row["updated_at"]. "</td> 
        </tr>";
    }
    echo "</table>";
} else {
    echo "No students registered yet.";
}

// Close the connection
close_connection();
?>

                                 </div>
                     

                </div>
             </div>   

        </div>

    </div>  
</div>
</div>        

    </div>
    <!-- /page content -->
</div>
</body>
</html>

<?php
include 'footer.php';

?>
            </div>
        </div>
    </div>
  </div>
  </div> 
  <script>
    var humburger=document.querySelector(".humburger")
    var wrapper=document.querySelector(".wrapper")
    var backdrop=document.querySelector(".backdrop")

    humburger.addEventListener("click", function(){
        wrapper.classList.add("active");
    })

    backdrop.addEventListener("click", function(){
        wrapper.classList.remove("active");
    })
  </script>
</body>
</html>

