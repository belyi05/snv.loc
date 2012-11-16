$(function(){
	$("#largo").click(function(){
		remove_marker();
		var elem = $("#dom1");
		if(elem.hasClass('hidden'))
			elem.removeClass('hidden');
		return false;
		
	});
	
	$("#allegro").click(function(){
		remove_marker();
		var elem = $("#dom2");
		if(elem.hasClass('hidden'))
			elem.removeClass('hidden');
		return false;
		
	});
	
	$("#presto").click(function(){
		remove_marker();
		var elem = $("#dom3");
		if(elem.hasClass('hidden'))
			elem.removeClass('hidden');
		return false;
		
	});
	
	$("#adazhio").click(function(){
		remove_marker();
		var elem = $("#dom4");
		if(elem.hasClass('hidden'))
			elem.removeClass('hidden');
		return false;
		
	});
	
	$(".closemarker").click(function(){
		$(this).parents().filter('.info').addClass('hidden');
	});
});

function remove_marker(){
	var doma = new Array('#dom1', '#dom2', '#dom3', '#dom4');
	for(i=0;i<4;i++){
			if(!$(doma[i]).hasClass('hidden'))
				$(doma[i]).addClass('hidden');
		}
}