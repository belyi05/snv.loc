// JavaScript Document
function href (url)
	{
	// нужно доделать в новом окне если http://
	document.location=url;
	}
	
// открыть закрыть без статуса
var DivS=new Array();
function Div (ID, Status)
	{
	if (typeof (ID)!='object') { var El=document.getElementById (ID);} else { El=ID; }
	// элемент есть 
	if (El) 
		{
		if (Status=='auto') 
			{
			if (!DivS[ID])
				{
				Status=1;
				} else {
				if (DivS[ID]==1) 
					{
					Status=0;
					} else {
					Status=1;
					}
				}
			}
		// 
		if (Status!=1 && Status!==true) 
			{
			El.style.display="none";
			El.style.visibility="hidden";
			DivS[ID]=0;
			}  else {

			var Display='block';
			if (El.tagName) 
				{
				var Tag=El.tagName.toLowerCase();
				if (Tag=='tr') 
					{
					Display='table-row';
					}
				if (Tag=='th' || Tag=='td') 
					{
					Display='table-cell';
					}
				if (Tag=='tbody') 
					{
					if (browserVersion()==7)
						{
						// ie7
						Display='block';	
						} else {
						Display='table-row-group';
						}
					}
				}

			El.style.display=Display;
			El.style.visibility="visible";
			DivS[ID]=1;
			}
		}
	}