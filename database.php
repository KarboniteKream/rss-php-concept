<?php
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
	$host = $url["host"];
	$db = substr($url["path"], 1);
	$conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $url["user"], $url["pass"]);
?>
