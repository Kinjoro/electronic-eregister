$(document).ready(function(){
	$('#intervalSubmit').click(function() { 
		var interval;
		var type = $('#type_select option:selected').val();
		
		if($('#timeButton0').prop('checked')){
			interval = "1M";
		}
		else if($('#timeButton1').prop('checked')){
			interval = "6M";
		}
		//else if($('#timeButton2').prop('checked')){
		//	interval = "M";
		//}
		else if($('#timeButton3').prop('checked')){
			interval = "Y";
		}
		else
			console.log(interval);
		window.location.href = "intervalReport.php?interval="+interval+"&type="+type+"";
	});
});