<?php
	session_start();

	require("database.php");
	$statement = $conn->prepare("SELECT name FROM Feeds WHERE id = :id");
	$statement->bindParam(":id", $_SESSION["location"]);
	$statement->execute();

	$feed = $statement->fetch(PDO::FETCH_OBJ);
	echo $feed->name;

	$statement = null;
	$conn = null;
?>
