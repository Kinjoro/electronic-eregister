$(document).ready(function(){
	//Modal Redirection
	$('#redirectButtonOUT').click(function redirect1(){

		//When I step into this on the debugger, it executes fine. Only in firefox apparently.
		//It behaves like its just ignoring the line entirely.
		var laptop = $('#laptop_name_out').text();
		var assistant = $('#laptop_name_out').attr('value');
		console.log(laptop);
		
		window.location.href = "laptop_checkout.php?laptop="+laptop+"&assistant="+assistant+"&inOut=OUT";
		
		return false;
	});
	$('#redirectButtonIN').click(function redirect2(){

		//When I step into this on the debugger, it executes fine. Only in firefox apparently.
		//It behaves like its just ignoring the line entirely.
		var laptop = $('#laptop_name_in').text();		
		var assistant = $('#laptop_name_in').attr('value');
		console.log(laptop);
		
		window.location.href = "laptop_checkout.php?laptop="+laptop+"&assistant="+assistant+"&inOut=IN";
		return false;
	});
	//Takes the value of the button clicked, and moves it into the modal window.
	$('#laptop_1_in').click(function(){ //For check out of laptop 1
		var value = $(this).val();
		console.log(value);
		var body = $('#laptop_name_out');
		body.html(value);
		
	});
	$('#laptop_1_out').click(function(){ //For check in of laptop 1
		var value = $(this).val();
		console.log(value);
		var body = $('#laptop_name_in');
		body.html(value);
	});
	$('#laptop_2_in').click(function(){ //For check out of laptop 2
		var value = $(this).val();
		console.log(value);
		var body = $('#laptop_name_out');
		body.html(value);
	});
	$('#laptop_2_out').click(function(){ //For check in of laptop 2
		var value = $(this).val();
		console.log(value);
		var body = $('#laptop_name_in');
		body.html(value);
	});
	$('#laptop_3_in').click(function(){ //For check out of laptop 3
		var value = $(this).val();
		console.log(value);
		var body = $('#laptop_name_out');
		body.html(value);
		
	});
	$('#laptop_3_out').click(function(){ //For check in of laptop 3
		var value = $(this).val();
		console.log(value);
		var body = $('#laptop_name_in');
		body.html(value);
	});
	$('#laptop_4_in').click(function(){ //For check out of laptop 3
		var value = $(this).val();
		console.log(value);
		var body = $('#laptop_name_out');
		body.html(value);
	});
	$('#laptop_4_out').click(function(){ //For check in of laptop 3
		var value = $(this).val();
		console.log(value);
		var body = $('#laptop_name_in');
		body.html(value);
	});
	$('#laptop_5_in').click(function(){ //For check out of laptop 3
		var value = $(this).val();
		console.log(value);
		var body = $('#laptop_name_out');
		body.html(value);

	});
	$('#laptop_5_out').click(function(){ //For check in of laptop 3
		var value = $(this).val();
		console.log(value);
		var body = $('#laptop_name_in');
		body.html(value);
	});
	$('#laptop_6_in').click(function(){ //For check out of laptop 3
		var value = $(this).val();
		console.log(value);
		var body = $('#laptop_name_out');
		body.html(value);
	});
	$('#laptop_6_out').click(function(){ //For check in of laptop 3
		var value = $(this).val();
		console.log(value);
		var body = $('#laptop_name_in');
		body.html(value);
	});
	$('#laptop_7_in').click(function(){ //For check out of laptop 3
		var value = $(this).val();
		console.log(value);
		var body = $('#laptop_name_out');
		body.html(value);
	});
	$('#laptop_7_out').click(function(){ //For check in of laptop 3
		var value = $(this).val();
		console.log(value);
		var body = $('#laptop_name_in');
		body.html(value);
	});
	
});