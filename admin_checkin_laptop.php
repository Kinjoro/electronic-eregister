<?php
session_start();
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
                            <a href="dashboard.php" class="active">
                                <span class="icon">
                                <i class="fa-solid fa-gauge-high"></i>
                                </span>
                                
                                <span class="text">Dashboard</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="dashboard.php" class="">
                                <span class="icon">
                                <i class="fa-solid fa-house"></i>
                                </span>
                                <span class="text">Home</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="checkin_laptop.php" class="">
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
                            <a href="login.php" class="">
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
                <h1> Laptops Checkin Admin-Page</h1>
                <div class="item">
                <form name="" action="" method="POST" >
                    <table>
                        <tr>
                            <td>
                                <select class="form-control selectpicker" >
                                    <?php
                                    $res=mysqli_query($link, "SELECT * FROM students WHERE registration_number='INTE/MG/3073/09/20'" ); 
                                    while ($row= mysqli_fetch_array($res))
                                    
                                    {
                                   echo "<option>";
                                    echo $row["registration_number"];
                                   echo "</option>";
                                    }
                                    ?>
                                </select>

                            </td>
                            <td>
                               <input type="submit1" value="Search" name="submit"class="form-control btn btn-default">
                            </td>
                        </tr>
                    </table>

                    <?php 
                    if (isset($_POST["submit1"]))
                    {
                        ?>
                        <table>
                            <tr>
                                <td>
                                    <imput type="text" class="form-control" placeholder="registration_number" name="registration_number" disabled ></imput>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <imput type="text" class="form-control" placeholder="school_email" name="school_email" required ></imput>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <imput type="text" class="form-control" placeholder="phone_number" name="phone_number" required ></imput>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <imput type="text" class="form-control" placeholder="role" name="role" required ></imput>
                                </td>
                            </tr>
                            <?php 
                    }
                            ?>
                            <tr>
                            <td>
                                <select  name="laptop_serial_number" class="form-control selectpicker" >
                                    <?php
                                    $res=mysqli_query($link, "SELECT * FROM laptops WHERE laptop_serial_number=?" ); 
                                    while ($row= mysqli_fetch_array($res))
                                    
                                    {
                                   echo "<option>";
                                    echo $row["laptop_serial_number"];
                                   echo "</option>";
                                    }
                                    ?>
                                </select>

                            </td>
                            </tr>
                            <tr>
                            <td>
                               <input type="submit2" value="Checkin laptop" name="submit"class="form-control btn btn-default" style="background-color:blue; color:white" >
                            </td>
                        </tr>
                        <?php 
                    if (isset($_POST["submit2"]))
                    {
                        ?>
                       <?php
                    }
                    ?>

                        </table>
                
                                    <?php
                                    $res=mysqli_query($link, "SELECT * FROM laptops WHERE registration_number='INTE/MG/3073/09/20'" ); 
                                    while ($row= mysqli_fetch_array($res))
                                    
                                    {
                                   echo "<option>";
                                    echo $row["registration_number"];
                                   echo "</option>";
                                    }
                                    ?>
                       
                               



                </form>
            <section>
                <?php
        include 'footer.php';
 ?>
                </section>s  
                </div>                 
            </div>
        </div>
    </div>
  </div>
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
