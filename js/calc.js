$(function(){
	$("#gocalc").click(function(){
		var summ = $("#summ").val();
		var srok = $("#srok").val();
		var flag = 0;
		
		if(summ == '' || summ == ' ' || summ == '0'){
			alert('Не заполнена сумма кредита');
			flag = 1;
			return false;
		}
		
		var itog = 0;
		summ = parseInt(summ);
		
		if(srok == '6')
			itog = summ / 6;
		else if(srok == '1')
			itog = (summ * 1.05) / 12;
		else if(srok == '2')
			itog = (summ * 1.115) / 24;
		
		itog = itog.toFixed();
		itog = number_format(itog, 0, '', ' ');
		$("#result").html(itog+" руб.");
		
	});
});


function number_format( number, decimals, dec_point, thousands_sep ) 
{  // Format a number with grouped thousands
    // 
    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     bugfix by: Michael White (http://crestidg.com)
 
    var i, j, kw, kd, km;
 
    // input sanitation & defaults
    if( isNaN(decimals = Math.abs(decimals)) ){
        decimals = 2;
    }
    if( dec_point == undefined ){
        dec_point = ",";
    }
    if( thousands_sep == undefined ){
        thousands_sep = ".";
    }
 
    i = parseInt(number = (+number || 0).toFixed(decimals)) + "";
 
    if( (j = i.length) > 3 ){
        j = j % 3;
    } else{
        j = 0;
    }
 
    km = (j ? i.substr(0, j) + thousands_sep : "");
    kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
    //kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
    kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");
 
 
    return km + kw + kd;
}