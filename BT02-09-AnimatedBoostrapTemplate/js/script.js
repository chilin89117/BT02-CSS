$(document).ready(function () {
	$("#imac").addClass("animate");
	
	$(window).scroll(function () {
		var y = $(this).scrollTop();
		if (y >= 250) {
			$("#laptop").addClass("animate");
			$("#mobile").addClass("animate");
			$("#imac").removeClass("animate");
		}
		if (y < 250) {
			$("#laptop").removeClass("animate");
			$("#mobile").removeClass("animate");
			$("#imac").addClass("animate");
		}
	});
});