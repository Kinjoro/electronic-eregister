
// This allows the calender to be displayed for date selection. 
$(document).ready(function() {
	$("#date").datepicker();
	// The cancel button that redirects back to the buttons page.
	$('#cancelButton').click(function() {
		console.log("Canceling Form");		
		alert("Request Canceled.");
		window.location.href = "http://webtest.chass.ncsu.edu/nrbuchan/it/laptop_checkout/index.php";	
		return false;	
	});
});
