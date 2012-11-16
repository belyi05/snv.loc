/////////////// ЗАКАЗ ЗВОНКА //////////////////////
$(function(){
	$("#zvonok").submit(function(){
		var name = $("#zv_name");
		var phone = $("#zv_phone");
		var flag = 0;
		
		// телефон
		if(!phone.val().match( /^[0-9-+]+$/)){
			phone.css('border', '2px solid red');
			flag = 1;
		}
		if(name.val() == '' || name.val().match( /\s/)){
			name.css('border', '2px solid red');
			flag = 1;
		}
		
		if(flag == 1){
			return false;
		}
		else{
			var datapost = 'name='+encodeURI(name.val())+'&phone='+phone.val();
			$.post('/zvonok.php', datapost, function(mes){
				var form = $("div.zvonok");
				var res_block = $("#zv_result");
				form.hide();
				res_block.html(mes);
				res_block.fadeIn();
				phone.val('');
				name.val('');
				setTimeout(function(){
					res_block.hide();
					form.fadeIn();
				}, 5000);
				
				return false;
			}, 'html');
		return false;
		}
	});
	
	
	$("#feedback").submit(function(){
		var name = $("#fb_name");
		var phone = $("#fb_phone");
		var email = $("#fb_email");
		var comm = $("#fb_q");
		var flag = 0;
		 
	 
		// телефон
		if(!phone.val().match( /^[0-9-+]+$/)){
			phone.css('border', '2px solid red');
			flag = 1;
		}
		if(name.val() == '' || name.val().match( /\s/)){
			name.css('border', '2px solid red');
			flag = 1;
		}
		
		if(flag == 1){
			return false;
		}
		else{
			var datapost = 'name='+encodeURI(name.val())+'&phone='+phone.val()+'&email='+email.val()+'&comm='+comm.val();
			$.post('/feedback.php', datapost, function(mes){
				var form = $("div.feedback");
				var res_block = $("#feedback_result");
				form.hide();
				res_block.html(mes);
				res_block.fadeIn();
				phone.val('');
				name.val('');
				email.val('');
				comm.val('');
				setTimeout(function(){
					res_block.hide();
					form.fadeIn();
				}, 5000);
				
				return false;
			}, 'html');
		return false;
		}
	
});	
});		