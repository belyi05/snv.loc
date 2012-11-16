<?php
require_once(dirname(__FILE__).'/libmail.php');

	if(count($_POST) > 0)
		{
			// извлекаем данные
			$name = htmlspecialchars(trim($_POST["name"]));
			//$name = iconv("windows-1251", "utf-8", $name);
			$famil = htmlspecialchars(trim($_POST["famil"]));
			//$famil = iconv("windows-1251", "utf-8", $famil);
			$phone = htmlspecialchars(trim($_POST["phone"]));
			if(isset($_POST["email"]))
				$email = htmlspecialchars(trim($_POST["email"]));
			else
				$email = '';
			// фиксим телефон под общий формат
			$unit = Array("+", "-", "(", ")", " ", "  ");
			$repl = Array("", "", "", "", "", "");
			$phone = str_replace($unit, $repl, $phone);
			if(substr($phone, 0, 1) == '8'){
				$phone = '7'.substr($phone, 1);
			}
			
			// Проверяем существует ли пользователь с таким телефоном
			db_connect();
			$query = "SELECT * FROM `users` WHERE `phone`='".$phone."'";
			$user_exists = mysql_query($query);
			//echo 'mysql_num -'.mysql_num_rows($user_exists);
			if(mysql_num_rows($user_exists) > 0)
				{
					if($_POST["action"] == 'prov')
						{
							echo 'Пользователь с таким телефоном уже зарегистрирован';
						}
				}
			else{
					if($_POST["action"] == 'prov')
						{
							echo 'no users';
						}
					else{
			
							$tmp_pass = md5(uniqid(rand(),true));
							$pass = substr($tmp_pass, 0, 7);
							$pass_db = md5($pass);
							$date = date("Y-m-d");
							
							$query = "INSERT INTO `users`(`name`, `famil`, `phone`, `email`, `pass`, `date`) VALUES('".$name."', '".$famil."', '".$phone."', '".$email."', '".$pass_db."', '".$date."')";							
							$res = mysql_query($query);
							if(!$res)
								echo 'Ошибка при добавлении пользователя'.mysql_error();
							
							$from = 'Gorki10';
							$headers  = "MIME-Version: 1.0\r\n";
							$headers .= "Content-type: text/plain; charset=utf-8\r\n";
							$headers .= "From: ".$from."\r\n";
							
							$pismo = "user=insaito
							pass=9013703339
							fromPhone=Gorki-10
							tels=".$phone."
							mess=Ваш пароль: ".$pass;

							//$to2 = 'ad@insaito.ru';
							$to = 'post@websms.ru';
							
							// инициализация объекта отправки письма
							$m = new Mail("utf-8"); 
							$m->From($from); 
							$m->To($to); 
							$m->Subject("websms");    
							$m->Priority(3) ;    // приоритет письма
							$m->Body($pismo);	

							//if(mail($to2, $subject, $pismo, $headers)){
							$m->Send();
							$otvet = 'Вы успешно зарегистрированы. Пароль будет выслан вам по sms.';
								
							//}	
							//else{ $otvet = 'Ошибка при регистрации. Попробуйте позже';}	
							//echo iconv("utf-8", "windows-1251", $otvet);
							echo $otvet;
						}
				}
		}
		
function db_connect(){
$ln_db = mysql_connect("mysql.Invest10.z8.ru", "dbu_invest10_2", "w2GRrcgpfRy");
if(!$ln_db)
	echo 'No connect';
if(!mysql_select_db('db_invest10_2', $ln_db)){
	echo 'No DB';
	}
else{
	mysql_query("SET NAMES utf8");	
	return true;
	}
}		
?>