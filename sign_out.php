<?php
	if(session_start() == true)
	{
		unset($_COOKIE["remember_me"]);
		setcookie("remember_me", NULL, -1);
		session_unset();
		$root = $_SERVER["HTTP_HOST"];
		header("Location: http://$root");
	}
?>
