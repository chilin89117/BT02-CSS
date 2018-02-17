$(document).ready(function () {
	var mth = $("#m-select").val();
	var yr = $("#y-select").val();
	var input_yr_mth = yr + '-' + mth + '%';
	
	$.ajax({
		method:		'POST',
		url:				'u12_02.php',
		data:			{input: input_yr_mth},
		dataType:	'json',
		success:		function (evts) {
								for(var i = 0; i < evts.length; i++) {
									var eventDate = evts[i].dd;
									var eventDescript = evts[i].descript; 

									var output = "<div class='event'>";													
									output += "<div class='event-desc'>";
									output += eventDescript;
									output += "</div>";
									output += "</div>";
														
									$("#" + eventDate).append(output);
								}
							}
	})	;	
})

/*
<div class="event-desc">
	HTML5 lecture with Brad Traversy from Eduonix
</div>
*/							
