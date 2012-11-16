<link rel="stylesheet" href="css_.css" type="text/css">
<script type="text/javascript" src="js/js.js"></script>
<!-- Arquivos utilizados pelo jQuery lightBox plugin -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.lightbox-0.5.css" media="screen">
<script type="text/javascript">
$(function() { $('table td.content a.open').lightBox(); });
$(function() { $('table td.content a.open1').lightBox(); });
$(function() { $('table td.content a.open2').lightBox(); });
$(function() { $('table td.content a.open3').lightBox(); });
$(function() { $('table td.content a.open4').lightBox(); });
$(function() { $('table td.content a.open5').lightBox(); });
</script>
<!-- / fim dos arquivos utilizados pelo jQuery lightBox plugin -->
<?
function is_page ($Link, $Name)
	{
	$H='';
	if (!preg_match('~(/|^)'.$Link.'$~', $_SERVER['REQUEST_URI']))
		{
		$H='<a href="'.$Link.'">'.$Name.'</a>';
		} else {
		$H=$Name;
		}
	echo $H;
	return;
	}
?>