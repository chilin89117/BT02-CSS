/* See Fancybox documentation at http://fancyapps.com/fancybox/ */

$(document).ready(function() {
	$(".fancybox").fancybox({
		helpers: {
			buttons: {	},
			thumbs: {
				width: 75,
				height: 75						
			}
		}				
	});
	
	$('.filter').on('click', function () {
		var thisItem = $(this);
		if (!thisItem.hasClass('active')) {
			$('.filter').removeClass('active');
			thisItem.addClass('active');
			
			var category = thisItem.data('rel');

			if (category == 'all') {
				$('.fancybox').fadeOut(0)
											.attr('data-fancybox-group', 'gallery')
											.fadeIn(2000);
			} else {
				$('.fancybox').fadeOut(0)
											.filter(function () {
												return $(this).data('filter') == category;
											})
											.attr('data-fancybox-group', category)
											.fadeIn(1000);
			}
		}
	});
});