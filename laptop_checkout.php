<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="times.js"></script>
<script src="redirection.js"></script>

<?php	
//require //'form_checks.php';
//require //'webapp_api.inc';
//$web_app = new WebApp('eng101_laptop_checkout');
//$web_app->logMessage("Access Successful");
//$web_app->checkAccess('view');
//$web_app->showHeader();
//Database information and connection
$host = "localhost";
$user = "root";
$password = "";
$dbc = mysqli_connect($host, $user, $password, );
if( mysqli_connect_errno() ){
	echo "Failed to Connect";
}


//ID's and email
$instructor_id = (array_key_exists('instructor_id', $_POST) && $_POST['instructor_id']) ? htmlspecialchars(trim($_POST['instructor_id'])) : '';
$email = (array_key_exists('email', $_POST) && $_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : ''; // not user set
//Date
$time = date("c");
//Item availability
$lpt_check = "SELECT ID FROM fyw_checkout.laptop_status WHERE Status = 'IN'";
$laptop_query = $dbc->query($lpt_check);
$lpt_check_out = "SELECT ID FROM fyw_checkout.laptop_status WHERE Status = 'OUT'";
$laptop_query_out = $dbc->query($lpt_check_out);

if( isset($_GET['laptop'], $_GET['inOut'], $_GET['assistant']) ){
	$laptop_id = $_GET['laptop'];
	$inOut = $_GET['inOut'];
	$assistantId = $_GET['assistant'];
} else {
	$laptop_id = '';
	$inOut = '';
	$assistantId = '';
}
if($inOut == 'IN'){
	$dbcCheck = "SELECT Instructor_ID, Email FROM fyw_checkout.laptop_checkout 
				WHERE (Laptop_ID='$laptop_id') AND (Status='OUT') AND (Time_Out >= NOW() - INTERVAL 1 WEEK) AND ( UNIX_TIMESTAMP(Time_In)=0 )";
	if( !($dbc->query($dbcCheck)) )
		echo "<script> console.log('Query Failure: ".mysqli_connect_errno()."'); </script>";
	else{
		$checkInInfo = $dbc->query($dbcCheck);
		$row = $checkInInfo->fetch_row();
		$instructor_id = $row[0];
		$email = $row[1];
	}
}
//Query submition checks.
//Reports any errors with dbc connection/query.
if(isset($_POST['submit'])){
	$error_message = '';	
	$laptop_id = $dbc->real_escape_string($laptop_id);
	$instructor_id = $dbc->real_escape_string($instructor_id);
	$email = $dbc->real_escape_string($email);
	//$newDate = $dbc->real_escape_string($newDate);
	$assistantId = $dbc->real_escape_string($assistantId);
	$time = $dbc->real_escape_string($time);
	if ($inOut == 'OUT'){
		//$time = date("c");
		//$newDate = date("y-m-d", strtotime($date));	
		$query = "INSERT INTO fyw_checkout.laptop_checkout (Status, Laptop_ID, Instructor_ID, Email, Assistant_ID, Time_Out) 
					VALUES ('$inOut', '$laptop_id', '$instructor_id', '$email', '$assistantId', '$time')";
		$update = "UPDATE fyw_checkout.laptop_status SET Status='OUT' WHERE ID='".$laptop_id."'";
	} else if ($inOut =='IN'){
		//$time = date("c");
		//$newDate = date("y-m-d", strtotime($date));	
		$query = "UPDATE fyw_checkout.laptop_checkout SET Status='IN', Time_In='$time' 
					WHERE (Laptop_ID='$laptop_id') AND (Status='OUT') AND (Instructor_ID='$instructor_id')";
		$update = "UPDATE fyw_checkout.laptop_status SET Status='IN' WHERE ID='".$laptop_id."'";					
	}
	if(!$dbc->query($update) || !$dbc->query($query)){
		die("Failed to connect to database: " . mysqli_connect_errno());
		
		echo "<div class='alert alert-danger text-center'>";
        echo "<strong>There was a problem submitting your request.</strong>";
        echo " Please <a href='mailto:chass_it@ncsu.edu'>email CHASS IT</a> at chass_it@ncsu.edu for assistance.";
        echo "</div>";
	} else {
		//Send an email confirming the checkout/checkin
		$message = "Laptop check-$inOut has been recorded:<br /><br />";
		$message .= "Laptop ID: $laptop_id<br />";
		$message .= "Instructor: $instructor_id<br />";
		$assistant_name = "assistant";//$_SERVER['SHIB_DISPLAYNAME'];
		$message .= "Assistant: ( $assistantId ) $assistant_name<br />";
		$message .= "In or Out: $inOut<br />";
		$newTime = date("r");
		$message .= "Time: $newTime<br />";
		if($inOut == "OUT"){
			$newTime = date("r", time()+(24*60*60));
			$message .= "Return by: $newTime <br />";	
		}
		$headers = "MIME-Version: 1.0" . "\r\n" .
		"Content-type: text/html; charset=UTF-8" . "\r\n";
		$to = $instructor_id . "@ncsu.edu";
		
		if($email != $to){ //If the email given is not their ncsu email
			$headers .= "CC: $email";
			//$message .= "CC'd to: $email";
		}
		$from = "ryanbuchanan21@gmail.com";
		$subject = "Laptop Checkout";
		mail($to, $subject, $message, $headers, "-f" . $from);
		session_unset();
		header('Location: index.php?success=true&inOut='. $inOut .'');
		exit;		
	}
	if((isset($error_message) && strlen($error_message) == 0)){
		header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."?".$_SERVER['QUERY_STRING']);
		exit();
	}	
}
//require_once //'template_top.inc';

// show any form validation error messages
if (isset($error_message) && !empty($error_message)) {
	echo "<div class='alert alert-danger text-center'>";
	echo $error_message;
	echo "</div>";
}?>
<div class="col-sm-11 col-sm-offset-3"> <!-- HEADER -->
	<h1 class="section-head"> Laptop Check-<?php echo $inOut; ?> </h1></br>
</div>
<!-- FORM -->
<form class="form-horizontal" id="checkout_form"
   name="checkout" action="#" method="post">
   <!-- In/Out 
   <div class="form-group" id="out_in">
   <label class="col-sm-3 control-label" for="out_in">Out/In: </label>
			<div class="col-sm-2">
				<div class="radio-inline">
					<input type="radio" name="out_in" value="OUT" onclick="show1();" required>Out</input>				
				</div>
				<div class="radio-inline">
					<input type="radio" name="out_in" value="IN" onclick="show2();" required>In</input>
				</div>
			</div>
	</br></br>
	</div>
	-->
	<div class="form-group" id="laptopDisplay">
		<label class="col-sm-11 col-sm-offset-3"> <?php echo $laptop_id; ?> </label>
	</div>
		<!-- NAME -->
    <div class="form-group" id="instructor_id/email">
		<label class="col-sm-3 control-label" for="instructor_id">Instructor Unity ID: </label>
		<div class="col-sm-2">
			<input class="form-control"  type="input" id="instructor_id"
				name="instructor_id" placeholder="Instructor ID" value="<?php echo $instructor_id; ?>" required maxlength=8>
		</div>	
		<!-- EMAIL -->
		<label class="col-sm-1 control-label" for="email">Email: </label>
		<div class="col-sm-2">
			<input class="form-control"  type="email" id="email" name="email" placeholder="Email"
				 value="<?php echo $email; ?>" required maxlength=50>
		</div>		
	</div>
	
	<!-- ASSISTANT -->
	<div class="form-group" id="assistant">
		<label class="col-sm-3 control-label" for="assistant_id">Assistant ID: </label>
			<div class="col-sm-2">
				<input class="form-control"  type="input" id="assistant_id"
					name="assistant_id" placeholder="Assistant ID" value="<?php echo $assistantId; ?>" disabled maxlength=8>
			</div>				
	</br></br>
	</div>
	<!-- SUBMIT -->
	<div class="col-sm-offset-3" id="buttons">
		<div class="form-group col-sm-2" id="submit">
				<button class="btn btn-primary btn-lg" type="submit" id="submit"
				name="submit" > Submit </button>			
		</div>
		<!-- CANCEL -->
		<div  id="cancel" >
			<div class="col-sm-2">
				 <button class="btn btn-primary btn-lg" id="cancelButton" name="cancelButton" formnovalidate> Cancel </button>				
			</div>
		</div>
	</div>
	<div>
		</br>
	</div>
</form>
<?php	//include_once 'template_middle.inc'; ?>
<?php//	include_once 'template_bottom.inc'; ?>