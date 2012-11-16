$(function(){
	$("#reg_form").submit(function(){
		var name = $("#register_form #name_f");
		var famil = $("#register_form #name_s");
		var phone = $("#register_form #phone");
		var email = $("#register_form #email");
		var flag = 0;
		var err = new Array();
		
		// телефон
		if(!phone.val().match( /^[0-9-+]+$/)){
			flag = 1;
			err.push('Поле "Телефон" заполнено не корректно. Введите <strong>только цифры</strong>');
		}
		// Имя
		if(!name.val().match(/[а-яА-я]+/)){
			flag = 1;
			err.push('Поле "Имя" заполнено не корректно. Введите имя русскими буквами');
		}
		// Фамилия
		if(!famil.val().match(/[а-яА-я]+/)){
			flag = 1;
			err.push('Поле "Фамилия" заполнено не корректно. Введите фамилию русскими буквами');
		}
		
		if(flag || err.length > 0){
			var errors = '';
			for(i=0;i < err.length;i++){
				var item =  err[i]+'<br />';
				errors += item;
			}
			$("#err_reg").html(errors).css('display', 'block');
			return false;
		}
		else{
			// Проверка существования пользователя
			var dataprov = 'name='+encodeURI(name.val())+'&famil='+encodeURI(famil.val())+'&phone='+phone.val()+'&action=prov&email='+email.val();
			
			$.post("/register/reg.php", dataprov, function(mes){
					if(mes != 'no users'){
						$("#err_reg").html(mes).css('display', 'block');
						return false;
					}
					
					else{
						// отправка формы
						var datapost = 'name='+encodeURI(name.val())+'&famil='+encodeURI(famil.val())+'&phone='+phone.val()+'&action=reg&email='+email.val();
						$.post("/register/reg.php", datapost, function(message){
							var result = $("#register_form #result");
							$("#reg_form").fadeOut(500);
							result.html(message);
							setTimeout(function(){result.fadeIn(500)}, 500);
							return false;
						}, 'html');
						return false;
					}
					
				}, 'html');
		}
		
		return false;
	});
});




$(function(){
	$("#login_form").submit(function(){
		var login = $("#login_form #login");
		var pass = $("#login_form #pass");
		var redirect = $("#login_form #redirect");
		var flag = 0;
		var err = new Array();
		
		// телефон
		if(!login.val().match( /^[0-9]+$/)){
			flag = 1;
			err.push('Поле "Логин" заполнено не корректно. Введите свой номер телефона в виде 79110010101');
		}
		if(!pass.val().match( /^[0-9a-zA-Z]+$/)){
			flag = 1;
			err.push('Поле "пароль" содержит не допустимые символы');
		}
		
		if(flag){
			var errors = '';
			for(i=0;i < err.length;i++){
				var item =  err[i]+'<br />';
				errors += item;
			}
			$("#login_form .errors").html(errors);
			return false;
		}
		else{
			var datapost = 'login='+login.val()+'&pass='+pass.val()+'&redirect='+redirect;
			$.post('/register/login_ajax.php', datapost, function(mes){
				if(mes == 'redirect')	
{

if(location.toString().split("-")[1].split(".")[0]=="gorki")location.replace("http://snvproject.ru/documents-gorki.htm");
				if(location.toString().split("-")[1].split(".")[0]=="berezovka")location.replace("http://snvproject.ru/documents-berezovka.htm");
				if(location.toString().split("-")[1].split(".")[0]=="pokrovskoe")location.replace("http://snvproject.ru/documents-pokrovskoe.htm");
				if(location.toString().split("-")[1].split(".")[0]=="pokrovskie")location.replace("http://snvproject.ru/documents-pokrovskie-gorki.htm");
}				
					 
				else
					$("#login_form .errors").html(mes);
			}, 'html');
			return false;
		}
	});
});


$(function(){
	$("#reg_link").click(function(){
		var elem = $("#register_block");
		if(elem.is(":hidden")){
			$("#register_block").slideDown();
			$("#reg_link #arrow").removeClass('arrow_dn').addClass('arrow_up');
		}
		else{
			$("#register_block").slideUp();
			$("#reg_link #arrow").removeClass('arrow_up').addClass('arrow_dn');
		}
	});
});




$(function(){
	$("#logout").click(function(){
		$.post("/register/logout.php", "action=logout", function(mes){
			if(mes)
			{
				if(location.toString().split("-")[1].split(".")[0]=="gorki")location.replace("http://snvproject.ru/documents-gorki.htm");
				if(location.toString().split("-")[1].split(".")[0]=="berezovka")location.replace("http://snvproject.ru/documents-berezovka.htm");
				if(location.toString().split("-")[1].split(".")[0]=="pokrovskoe")location.replace("http://snvproject.ru/documents-pokrovskoe.htm");
				if(location.toString().split("-")[1].split(".")[0]=="pokrovskie")location.replace("http://snvproject.ru/documents-pokrovskie-gorki.htm");
				
			}
		}, 'html');
	});
	return false;	
});


// забыли пароль
$(function(){
	$("#get_pass").click(function(){
		var tel = $("#tel");
		// телефон
		if(!tel.val().match( /^[0-9-+]+$/)){
			$("#err_fogot").html('<p>Поле "Телефон" заполнено не корректно. Введите <strong>только цифры</strong></p>').show();
		}
		else{
			var datapost = 'tel='+tel.val();
			$.post('/register/fogot.php', datapost, function(mes){
				$("#fogot").html(mes);
			}, 'html');
		}
	});
});

$(function(){
	$("#fogot_pass").click(function(){
		$("#fogot").slideToggle();
		return false;
	});
});




// Проверка мыла на корректность
function checkmail(value) {
		reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
		 if (!value.match(reg)) {
				return false;
			}
		else{
				return true;
			}
	}