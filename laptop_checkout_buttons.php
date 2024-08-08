<?php	
//include_once 'template_top.inc'; 
//require 'webapp_api.inc';
///$web_app = new WebApp('eng101_laptop_checkout');
//$web_app->logMessage("Access Successful");
//$web_app->checkAccess('view');
//$web_app->showHeader();

//Database information and connection
$host = "localhost";
$user = "root";
$password = "";
$dataBase = "fyw_checkout";
$dbc = mysqli_connect($host, $user, $password, $dataBase);
if( mysqli_connect_errno() ){
	echo "Failed to Connect";
}
$assistantId = "assistant1";//$_SERVER['SHIB_UID']; // not user set
$assistnant_name = "assistantName";//$_SERVER['SHIB_DISPLAYNAME'];

//Laptop ID's and Status' 

$l1 = $dbc->query("SELECT ID, Status FROM fyw_checkout.laptop_status WHERE Unique_Id=1");
$row1 = $l1->fetch_row();
$l1_status = $row1[1];
$laptop1 = $row1[0];
$l2 = $dbc->query("SELECT ID, Status FROM fyw_checkout.laptop_status WHERE Unique_Id=2");
$row2 = $l2->fetch_row();
$l2_status = $row2[1];
$laptop2 = $row2[0];
$l3 = $dbc->query("SELECT ID, Status FROM fyw_checkout.laptop_status WHERE Unique_Id=3");
$row3 = $l3->fetch_row();
$l3_status = $row3[1];
$laptop3 = $row3[0];
$l4 = $dbc->query("SELECT ID, Status FROM fyw_checkout.laptop_status WHERE Unique_Id=4");
$row4 = $l4->fetch_row();
$l4_status = $row4[1];
$laptop4 = $row4[0];
$l5 = $dbc->query("SELECT ID, Status FROM fyw_checkout.laptop_status WHERE Unique_Id=5");
$row5 = $l5->fetch_row();
$l5_status = $row5[1];
$laptop5 = $row5[0];
$l6 = $dbc->query("SELECT ID, Status FROM fyw_checkout.laptop_status WHERE Unique_Id=6");
$row6 = $l6->fetch_row();
$l6_status = $row6[1];
$laptop6 = $row6[0];
$l7 = $dbc->query("SELECT ID, Status FROM fyw_checkout.laptop_status WHERE Unique_Id=7");
$row7 = $l7->fetch_row();
$l7_status = $row7[1];
$laptop7 = $row7[0];

if(isset($_GET['success'], $_GET['inOut']) && $_GET['success'] == true){
	echo "<script> alert('Check-" . $_GET['inOut'] . " successful!'); </script>";
}
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type = "text/javascript" src = "redirection.js"></script>
<div class="col-sm-10 col-sm-offset-4"> <!-- HEADER -->
	<h1 class="section-head"> Laptop Selection </h1></br>
</div>
<form class="form-horizontal" id="laptop_form" name="laptop_form" action="#" method="post">
	<div id="buttons" class="container-fluid">
		<div class="row">
			<h3 class="col-lg-offset-2 col-lg-3"> <u> Currently In </u> </h3>
			<h3 class="col-lg-offset-3 col-lg-3"> <u>Currently Out</u> </h3>
		</div>

		<!-- LAPTOPS 1-3 IN/OUT -->
		<div class="row">
			<!-- IN -->
			<?php
			if($l1_status == 'IN'){
				echo "<div class='col-md-2'>".
					"<button id='laptop_1_in'type='button'class='btn btn-success btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestOUT' data-backdrop='false'title='Check Out Laptop 1'value='".$laptop1."'> " . $laptop1 . " </button>" .
				"</div>";
			} else {
				echo "<div class='col-md-2'>".
					"<button id='laptop_1_in'type='button'class='btn btn-success btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestOUT' data-backdrop='false'title='Check Out Laptop 1' value='".$laptop1."'disabled> " . $laptop1 . " </button>" .
				"</div>";			
			}
			if($l2_status == 'IN'){
				echo "<div class='col-md-2'>".
					"<button id='laptop_2_in'type='button'class='btn btn-success btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestOUT' data-backdrop='false'title='Check Out Laptop 2'value='".$laptop2."'>" . $laptop2 . " </button>" .
				"</div>";
			} else {
				echo "<div class='col-md-2'>".
					"<button id='laptop_2_in'type='button'class='btn btn-success btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestOUT' data-backdrop='false'title='Check Out Laptop 2' value='".$laptop2."'disabled>" . $laptop2 . " </button>" .
				"</div>";			
			}
			if($l3_status == 'IN'){
				echo "<div class='col-md-2'>".
					"<button id='laptop_3_in'type='button'class='btn btn-success btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestOUT' data-backdrop='false'title='Check Out Laptop 3'value='".$laptop3."'>" . $laptop3 . " </button>" .
				"</div>";
			} else {
				echo "<div class='col-md-2'>".
					"<button id='laptop_3_in'type='button'class='btn btn-success btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestOUT' data-backdrop='false'title='Check Out Laptop 3' value='".$laptop3."'disabled>" . $laptop3 . " </button>" .
				"</div>";			
			}
			//OUT
			if($l1_status == 'IN'){
				echo "<div class='col-md-2'>".
					"<button id='laptop_1_out'type='button'class='btn btn-danger btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestIN' data-backdrop='false'title='Check In Laptop 1' value='".$laptop1."'disabled>" . $laptop1 . " </button>" .
				"</div>";
			} else {
				echo "<div class='col-md-2'>".
					"<button id='laptop_1_out'type='button'class='btn btn-danger btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestIN' data-backdrop='false'title='Check In Laptop 1' value='".$laptop1."'>" . $laptop1 . " </button>" .
				"</div>";			
			}
			if($l2_status == 'IN'){
				echo "<div class='col-md-2'>".
					"<button id='laptop_2_out'type='button'class='btn btn-danger btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestIN' data-backdrop='false'title='Check In Laptop 2'value='".$laptop2."' disabled>" . $laptop2 . " </button>" .
				"</div>";
			} else {
				echo "<div class='col-md-2'>".
					"<button id='laptop_2_out'type='button'class='btn btn-danger btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestIN' data-backdrop='false'title='Check In Laptop 2'value='".$laptop2."'>" . $laptop2 . " </button>" .
				"</div>";			
			}
			if($l3_status == 'IN'){
				echo "<div class='col-md-2'>".
					"<button id='laptop_3_out'type='button'class='btn btn-danger btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestIN' data-backdrop='false'title='Check In Laptop 3' value='".$laptop3."'disabled>" . $laptop3 . " </button>" .
				"</div>";
			} else {
				echo "<div class='col-md-2'>".
					"<button id='laptop_3_out'type='button'class='btn btn-danger btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestIN' data-backdrop='false'title='Check In Laptop 3' value='".$laptop3."'>" . $laptop3 . " </button>" .
				"</div>";			
			}
			?>
		</div>
		</br>
		<!-- LAPTOPS 4-6 IN/OUT -->
		<div class="row">
			<!-- IN -->
			<?php
			if($l4_status == 'IN'){
				echo "<div class='col-md-2'>".
					"<button id='laptop_4_in'type='button'class='btn btn-success btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestOUT' data-backdrop='false'title='Check Out Laptop 4'value='".$laptop4."'>" . $laptop4 . " </button>" .
				"</div>";
			} else {
				echo "<div class='col-md-2'>".
					"<button id='laptop_4_in'type='button'class='btn btn-success btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestOUT' data-backdrop='false'title='Check Out Laptop 4' value='".$laptop4."'disabled>" . $laptop4 . " </button>" .
				"</div>";			
			}
			if($l5_status == 'IN'){
				echo "<div class='col-md-2'>".
					"<button id='laptop_5_in'type='button'class='btn btn-success btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestOUT' data-backdrop='false'title='Check Out Laptop 5'value='".$laptop5."'>" . $laptop5 . " </button>" .
				"</div>";
			} else {
				echo "<div class='col-md-2'>".
					"<button id='laptop_5_in'type='button'class='btn btn-success btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestOUT' data-backdrop='false'title='Check Out Laptop 5'value='".$laptop5."'disabled>" . $laptop5 . " </button>" .
				"</div>";			
			}
			if($l6_status == 'IN'){
				echo "<div class='col-md-2'>".
					"<button id='laptop_6_in'type='button'class='btn btn-success btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestOUT' data-backdrop='false'title='Check Out Laptop 6'value='".$laptop6."'>" . $laptop6. " </button>" .
				"</div>";
			} else {
				echo "<div class='col-md-2'>".
					"<button id='laptop_6_in'type='button'class='btn btn-success btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestOUT' data-backdrop='false'title='Check Out Laptop 6' value='".$laptop6."'disabled>" . $laptop6 . " </button>" .
				"</div>";			
			}
			//OUT
			if($l4_status == 'IN'){
				echo "<div class='col-md-2'>".
					"<button id='laptop_4_out'type='button'class='btn btn-danger btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestIN' data-backdrop='false'title='Check In Laptop 4' value='".$laptop4."'disabled>" . $laptop4 . " </button>" .
				"</div>";
			} else {
				echo "<div class='col-md-2'>".
					"<button id='laptop_4_out'type='button'class='btn btn-danger btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestIN' data-backdrop='false'title='Check In Laptop 4' value='".$laptop4."'>" . $laptop4 . " </button>" .
				"</div>";			
			}
			if($l5_status == 'IN'){
				echo "<div class='col-md-2'>".
					"<button id='laptop_5_out'type='button'class='btn btn-danger btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestIN' data-backdrop='false'title='Check In Laptop 5' value='".$laptop5."'disabled>" . $laptop5 . " </button>" .
				"</div>";
			} else {
				echo "<div class='col-md-2'>".
					"<button id='laptop_5_out'type='button'class='btn btn-danger btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestIN' data-backdrop='false'title='Check In Laptop 5'value='".$laptop5."'>" . $laptop5 . " </button>" .
				"</div>";			
			}
			if($l6_status == 'IN'){
				echo "<div class='col-md-2'>".
					"<button id='laptop_6_out'type='button'class='btn btn-danger btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestIN' data-backdrop='false'title='Check In Laptop 6' value='".$laptop6."'disabled>" . $laptop6 . " </button>" .
				"</div>";
			} else {
				echo "<div class='col-md-2'>".
					"<button id='laptop_6_out'type='button'class='btn btn-danger btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestIN' data-backdrop='false'title='Check In Laptop 6' value='".$laptop6."'>" . $laptop6 . " </button>" .
				"</div>";			
			}
			?>
		</div>
		</br>
		<!-- LAPTOP 7 IN/OUT -->
		<div class="row">
			<!-- IN -->
			<?php
			if($l7_status == 'IN'){
				echo "<div class='col-lg-offset-2 col-md-6'>".
					"<button id='laptop_7_in'type='button'class='btn btn-success btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestOUT' data-backdrop='false'title='Check In Laptop 7' value='".$laptop7."' >". $laptop7 . " </button>" .
					"</div>";
			} else {
				echo "<div class='col-lg-offset-2 col-md-6'>".
					"<button id='laptop_7_in'type='button'class='btn btn-success btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestOUT' data-backdrop='false'title='Check In Laptop 7' value='".$laptop7."'disabled>" . $laptop7 . " </button>" .
					"</div>";			
			}
			//OUT
			if($l7_status == 'IN'){
				echo "<div class='col-md-2'>".
					"<button id='laptop_7_out'type='button'class='btn btn-danger btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestIN' data-backdrop='false'title='Check In Laptop 7' value='".$laptop7."'disabled>". $laptop7 . " </button>" .
					"</div>";
			} else {
				echo "<div class='col-md-2'>".
					"<button id='laptop_7_out'type='button'class='btn btn-danger btn-lg'style='display:block'data-toggle='modal'".
						"data-target='#modaltestIN' data-backdrop='false'title='Check In Laptop 7' value='".$laptop7."'>" . $laptop7 . " </button>" .
					"</div>";			
			}
			?>
		</div>
		</br>
	</div>

	<!-- Modal for checkouts -->
	<div class="modal fade" id="modaltestOUT" tabindex="-1" role="dialog" aria-labelledby="modaltest" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> &times; </button>
					<h5 class="modal-title" id="modaltest">Laptop Checkout</h5>				
				</div>
				<div id="modal_OUT_body" class="modal-body">				
					<p>Checkout Confirmation for: </p>
					<p id="laptop_name_out" name="laptop_name_out"value="<?php echo $assistantId; ?>">
						<?php echo "<p> Assistant: ( " . $assistantId . " ) " . $assistnant_name . "</p>"; ?>
					</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="redirectButtonOUT" name="redirectButtonOUT">Continue to Checkout</button>
				</div>
			</div><!-- Modal Content -->
		</div><!--Modal Dialog-->
	</div><!-- Modal -->
	<!-- Modal for check ins-->
	<div class="modal fade" id="modaltestIN" tabindex="-1" role="dialog" aria-labelledby="modaltestIN" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> &times; </button>
					<h5 class="modal-title" id="modaltest">Laptop Check-In</h5>				
				</div>
				<div  id="modal_IN_body" class="modal-body">
					<p>Check-In Confirmation for: </p>
					<p id="laptop_name_in"value="<?php echo $assistantId; ?>"> 
						<?php echo "<p> Assistant: ( " . $assistantId . " ) " . $assistnant_name ."</p>"; ?>
					</p>
				</div>
				
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="redirectButtonIN" >Continue to Check-In</button>
				</div>
			</div><!-- Modal Content -->
		</div><!--Modal Dialog-->
	</div><!-- Modal -->
</form>
<?php//	include_once 'template_middle.inc'; ?>
<?php//	include_once 'template_bottom.inc'; ?>