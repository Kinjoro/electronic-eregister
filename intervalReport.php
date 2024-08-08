<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="timeSelect.js"></script>
<script src="sorttable.js"></script>

<?php	
//require 'form_checks.php';
//require 'webapp_api.inc';
//$web_app = new WebApp('eng101_laptop_checkout');
//$web_app->logMessage("Access Successful");
//$web_app->checkAccess('view');
//Database information and connection
$host = "localhost";
$user = "root";
$password = "";
$dbc = mysqli_connect($host, $user, $password, 'fyw_checkout');
if( mysqli_connect_errno() ){
	echo "Failed to Connect";
}
/*
* All of the following queries are sorted by the Time_In field, which corresponds to the time the device was returned.
*	The different queries are only different in that they have different time ranges for the data they contain.
*	Day, Week, Month, Year respectively.
*/
// 1 Month
$lpt_check_month = "SELECT * FROM fyw_checkout.laptop_checkout WHERE (Time_In >= NOW() - INTERVAL 1 MONTH) ORDER BY Time_In DESC";
$laptop_query_month = $dbc->query($lpt_check_month);
//6 Months
$lpt_check_6month = "SELECT * FROM fyw_checkout.laptop_checkout WHERE (Time_In >= NOW() - INTERVAL 6 MONTH) ORDER BY Time_In DESC";
$laptop_query_6month = $dbc->query($lpt_check_6month);
//Year
$lpt_check_year = "SELECT * FROM fyw_checkout.laptop_checkout WHERE (Time_In >= NOW() - INTERVAL 1 YEAR) ORDER BY Time_In DESC";
$laptop_query_year = $dbc->query($lpt_check_year);

//Below are some previous queries, maybe they will be useful, maybe not.

//$lpt_check_week = "SELECT * FROM fyw_checkout.laptop_checkout WHERE (Time_In >= NOW() - INTERVAL 1 WEEK) ORDER BY Time_In DESC";
//$laptop_query_week = $dbc->query($lpt_check_week);
//$lpt_check_perc = "SELECT * FROM fyw_checkout.laptop_checkout WHERE (Time_Out >= NOW() - INTERVAL 1 YEAR) ORDER BY Laptop_ID";
//$laptop_query_perc = $dbc->query($lpt_check_perc);

$interval = "";
$type = "";
$intName = "";
if(isset($_GET['interval'], $_GET['type'])){
	$interval = $_GET['interval'];
	$type = $_GET['type'];
	if($interval == '1M'){
		$intName = "1 Month";
	} else if($interval == '6M'){
		$intName = "6 Months";
	} else if($interval == 'Y'){
		$intName = "Year";
	}
}

//require_once 'template_top.inc';
?>
<div class="col-sm-4 col-sm-offset-5" id="Reports">
	<h3 class="section-head"> Report for the Past <?php echo $intName; ?></h3></br>			
</div>
<div class="col-sm-10 col-sm-offset-1">
	<ol>
		<?php 
			/*
				The lister function takes the type of report and the given SQL suery, 
				and prints out the appropriate list for that type.			
			*/
			function lister($t, $query){
				if($t == "Overall"){
					echo "<table class='table table-bordered table-striped sortable' id='intTable'>";
					echo "<thead><tr> <th>Laptop ID</th> <th>Instructor ID</th> <th>Email</th> <th>Time Out</th> <th>Time In</th> </tr></thead>";
					echo "<tbody>";
					while($data = $query->fetch_assoc()){
						echo "<tr>";
						echo "<td> " . $data['Laptop_ID'] . " </td>";
						echo "<td> " . $data['Instructor_ID'] . " </td>";
						echo "<td> " . $data['Email'] . " </td>";						
						echo "<td> " . $data['Time_Out'] . " </td>";
						echo "<td> " . $data['Time_In'] . " </td>";
						echo "</tr>";
					}
				} else if($t == "byUser"){
					echo "<table class='table table-bordered table-striped sortable' id='intTable'>";
					echo "<thead><tr> <th>Instructor ID</th> <th>Email</th> <th>Count</th> </tr></thead>";
					echo "<tbody>";
					$name_count = array();
					while($names = $query->fetch_assoc()){
						$n = $names['Instructor_ID'];
						//If name exists, increase its count.
						if(array_key_exists($n, $name_count) !== false){
							$name_count[$n]["count"]++;
						} else{
							$name_count[$n] = array();
						    $name_count[$n]["email"] = $names['Email'];
							$name_count[$n]["count"] = 1 ;
						}
						//If not create it and set count to 0.
					}
					foreach($name_count as $name=>$arr){
						echo "<tr>";
						echo "<td> " . $name . " </td>";
						echo "<td> " . $arr['email'] . " </td>";
						echo "<td> " . $arr['count'] . " </td>";
						echo "</tr>";
						//echo "</br>";
					}
				} else if($t == "byDevice"){
					echo "<table class='table table-bordered table-striped sortable' id='intTable'>";
					echo "<thead><tr> <th>Laptop ID</th> <th>Count</th> <th>Percentage</th> </tr></thead>";
					echo "<tbody>";
					$count = 0;
					$arrCount = array(0,0,0,0,0,0,0);
					while($data = $query->fetch_assoc()){
						$lpt = $data['Laptop_ID'];						
						$lpt_char = substr($lpt, 7);
						$num = intval($lpt_char);
						$arrCount[($num-1)]++;
						$count++;
					}
					//Print the rows
					for($i = 0; $i < 7; $i++){
						echo "<tr><td> Laptop " . ($i + 1) . "</td><td>" . $arrCount[$i] . "</td><td>" . round((($arrCount[$i]/$count) * 100), 2) . "</td></tr>";
					}
				}
			}
			switch($interval){
				case '1M':
					lister($type, $laptop_query_month);					
					break;
				case '6M':
					lister($type, $laptop_query_6month);
					break;
				case 'Y':
					lister($type, $laptop_query_year);
					break;
				default:
					break;
			}
			
			echo "</tbody>";
			echo "</table>";	
		?>
	</ol>
</div>