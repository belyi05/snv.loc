<?php
	if(count($_POST) > 0)
		{
			require_once(dirname(__FILE__).'/register/libmail.php');

			$name = htmlspecialchars(trim($_POST["name"]));
			//$name = iconv("windows-1251", "utf-8", $name);
			$phone = htmlspecialchars(trim($_POST["phone"]));
			$from = 'Gorki-10';
			$to = 'vvs@snvgroup.ru';
			//$to = 'welcome@snvgroup.ru';
			$pismo = '<h3>Заказ знонка на сайте gorki-10.spb.ru</h3>
			<p><strong>От:</strong> '.$name.'<br />
			<strong>Телефон:</strong> '.$phone.'</p>';
			
			// инициализация объекта отправки письма
			$m = new Mail("utf-8"); 
			$m->From($from); 
			$m->To($to); 
			$m->Subject("заказ звонка");    
			$m->Priority(3) ;    // приоритет письма
			$m->Body($pismo, "html");	
			$m->Send();
			
			//echo iconv("utf-8", "windows-1251", '<p>Ваша заявка отправлена</p>');
			echo 'Ваша заявка отправлена';
		}
	
?>