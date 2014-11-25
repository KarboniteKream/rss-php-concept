<?php
	$url = parse_url("http://www.phoronix.com/qweqweqwe/qwe/qwe/qw/e/qwe");
	print_r($url);
	exit();
	session_start();
	$icon = file_get_contents("http://www.google.com/s2/favicons");
	$id = 1;

	require("database.php");
	$statement = $conn->prepare("UPDATE Feeds SET icon = :icon WHERE id = :id");
	$statement->bindParam(":icon", $icon);
	$statement->bindParam(":id", $id);
	if($statement->execute())
		echo "OK";

	$statement = null;
	$conn = null;
?>
