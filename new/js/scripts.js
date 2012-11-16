$(document).ready(function() {
	jQuery('ul.menu').superfish();	
		
		
		
	(function($) {
		$(function() {
			
				$('ul.list').delegate('li:not(.current)', 'click', function() {
	
					$(this).addClass('current').siblings().removeClass('current').parents('.tabs-outer').find('.tab-box').hide().eq($(this).index()).fadeIn(150);
	
				});	
				
			});	 					 
					
	})(jQuery);	
	
	$(function() {
		$(".1 .slid").jCarouselLite({
			btnNext: ".1  .next-a",
			btnPrev: ".1  .prew-a",
			circular: false
		});
	});
	
	
	
	$(".slid ul li img").click(function() {
		$("#largeImg").attr("src", $(this).attr("src"));
	});
		
		
		
		
	});