<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://kit.fontawesome.com/b99e675b6e.js" ></script>

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
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "studentdb");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve checked-in laptops
$query = "SELECT * FROM laptopss WHERE status = 'out'";
$result = mysqli_query($conn, $query);

// Display the results in a table
if (mysqli_num_rows($result) > 0) {
    echo "<table class='table table-dark'>";
    echo "<tr>";
    echo "<th>Laptop ID</th>";
    echo "<th>Laptop Name</th>";
    echo "<th>Serial Number</th>";
    echo "<th>Status</th>";
    echo "</tr>";

    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["laptop_name"] . "</td>";
        echo "<td>" . $row["laptop_serial_number"] . "</td>";
        echo "<td>" . $row["status"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No checked-in laptops found.";
}

// Close the database connection
mysqli_close($conn);
?> 

  <?php
include'footer.php'; 
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
