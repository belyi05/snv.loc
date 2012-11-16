<?php
	if(count($_POST) > 0)
		{
			require_once(dirname(__FILE__).'/register/libmail.php');

			$name = htmlspecialchars(trim($_POST["name"]));
			//$name = iconv("windows-1251", "utf-8", $name);
			$phone = htmlspecialchars(trim($_POST["phone"]));
			$email = htmlspecialchars(trim($_POST["email"]));
			$comm = htmlspecialchars(trim($_POST["comm"]));
			$from = 'snvproject';
			//$to = 'belyi05@gmail.com';
			$to = 'welcome@snvgroup.ru';
			$pismo = '<h3>Обратная связь на сайте snvproject.ru</h3>
			<p><strong>От:</strong> '.$name.'<br />
			<strong>email:</strong> '.$email.'<br />
			<strong>Вопрос:</strong> '.$comm.'<br />
			<strong>Телефон:</strong> '.$phone.'</p>';
			
			// инициализация объекта отправки письма
			$m = new Mail("utf-8"); 
			$m->From($from); 
			$m->To($to); 
			$m->Subject("Обратная связь");    
			$m->Priority(3) ;    // приоритет письма
			$m->Body($pismo, "html");	
			$m->Send();
			
			//echo iconv("utf-8", "windows-1251", '<p>Ваша заявка отправлена</p>');
			echo 'Ваша заявка отправлена';
		}
	
?>