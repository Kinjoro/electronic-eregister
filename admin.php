<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="timeSelect.js"></script>

<?php	
//require 'form_checks.php';
//require 'webapp_api.inc';
//$web_app = new WebApp('eng101_laptop_checkout');
//$web_app->logMessage("Access Successful");
//$web_app->checkAccess('view');
//$web_app->showHeader();
//Database information and connection
$host = "localhost";
$user = "root";
$password = "";
$dbc = mysqli_connect($host, $user, $password);
if( mysqli_connect_errno() ){
	echo "Failed to Connect";
}
//Currently Out
$lpt_check_out = "SELECT * FROM fyw_checkout.laptop_checkout WHERE Status = 'OUT'";
$laptop_query_out = $dbc->query($lpt_check_out);


//Device Percentages
$lpt_check_perc = "SELECT * FROM fyw_checkout.laptop_checkout WHERE (Time_Out >= NOW() - INTERVAL 1 YEAR) ORDER BY Laptop_ID";
$laptop_query_perc = $dbc->query($lpt_check_perc);

//require_once 'template_top.inc';
?>
<div class="col-sm-11 col-sm-offset-3"> <!-- HEADER -->
	<h1 class="section-head"> Laptop CheckOut Reports </h1></br>
</div>
<!-- Currently out laptops -->
<div class="col-sm-5 col-sm-offset-1" id="Reports">
	<h3 class="section-head"> Currently Out </h3>	
	<?php 
		echo "<ul>";
		while($data = $laptop_query_out->fetch_assoc()){
			echo "<li>" . $data['Laptop_ID'] . ", " . $data['Instructor_ID'] . " : </br>" 
			. "Time Out: " . $data['Time_Out'] . "</li>";
		}
		echo "</ul>";
	?>
</div>
<!-- Reports by Time Interval -->
<div class="col-sm-6" id="IntervalReports">
	<h3 class="section-head"> Report </h3>	
	<!-- Interval Selection -->
	<input type="radio" name="interval" id="timeButton0" value="1M" > 1 Month </input>
	<input type="radio" name="interval" id="timeButton1" value="6M" > 6 Months </input>
	<!-- input type="radio" name="interval" id="timeButton2" value="M" > Month </input -->
	<input type="radio" name="interval" id="timeButton3" value="Y" > 1 Year </input></br></br>
	<!-- Type of Report -->
	<select name="type_select" id="type_select">
	  <option value="Overall" selected>Overall</option>
	  <option value="byUser">Checkouts by Instructor</option>
	  <option value="byDevice">Checkouts by Device</option>
	</select></br></br>
	<!-- Submit -->
	<button type="submit" class="btn btn-primary" id="intervalSubmit"> Submit </button></br></br>
	
</div>
</div>
<?php	//include_once 'template_middle.inc'; ?>
<?php	//include_once 'template_bottom.inc'; ?>