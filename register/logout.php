<?php
	if(isset($_POST["action"]) && $_POST["action"] == 'logout')
		{
			session_start();
			unset($_SESSION["user_id"]);
			unset($_SESSION["name"]);
			unset($_SESSION["famil"]);
			session_destroy();
			session_unset();
			echo 'redirect';
		}


?>