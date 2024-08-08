<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
</head>
<body>
<?php 
include'sidebar.php';
?>
<!-- page content-->
<div>
    <div class="right_col" role="main">
        <div class="title_left">
            <h3>Get help from the below admin.</h3>
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
                             <h2>Admin table.</h2>
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
$sql = "SELECT * FROM admins";
$result = $conn->query($sql);

// Display students in a table
if ($result->num_rows > 0) {
    echo "<table class='table table-dark'>";
    echo "<tr>
    <th>School Email</th>
    <th>Phone Number</th>
    <th>Role</th>
    <th>Created At</th>
    <th>Updated At</th>
    </tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["school_email"]. "</td>
        <td>" . $row["phone_number"]. "</td>
         <td>" . $row["role"]. "</td>
          <td>" . $row["created_at"]. "</td>
           <td>" . $row["updated_at"]. "</td> 
        </tr>";
    }
    echo "</table>";
} else {
    echo "No admin registered yet.";
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

include'footer.php';
?>