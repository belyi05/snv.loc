<?php
	if(count($_POST) > 0)
		{
			session_start();
			$login = htmlspecialchars(trim($_POST["login"]));
			$pass = htmlspecialchars(trim($_POST["pass"]));
			$redirect = htmlspecialchars(trim($_POST["redirect"]));
			
			$unit = Array("+", "-", "(", ")", " ", "  ");
			$repl = Array("", "", "", "", "", "");
			$login = str_replace($unit, $repl, $login);
			if(substr($login, 0, 1) == '8'){
				$login = '7'.substr($login, 1);
			}
			
			
			
			db_connect();
			$query = "SELECT * FROM `users` WHERE `phone`='".$login."'";
			$res = mysql_query($query);
			if(!$res)
				echo 'Ошибка при обращении к базе';
			if(mysql_num_rows($res) == 0)
				{
					echo 'Такой пользователь не зарегистрирован';
				}
			else{
					$user = mysql_fetch_array($res);
					if($user["pass"] == md5($pass))
						{
							$_SESSION["user_id"] = $user["id_user"];
							$_SESSION["name"] =  $user["name"];
							$_SESSION["famil"] = $user["famil"];
							//print_r($_SESSION);
							echo 'redirect';
							exit();
						}
					else{
							echo 'Неверный пароль';
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

