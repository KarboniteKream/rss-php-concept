<?php
	session_start();
	require("database.php");

	$statement = $conn->prepare("SELECT COUNT(article_id) AS unread FROM Unread WHERE user_id = :user_id");
	$statement->bindParam(":user_id", $_SESSION["user_id"]);
	$statement->execute();
	$unread = $statement->fetch(PDO::FETCH_OBJ)->unread;

	echo $unread;

	$statement = null;
	$conn = null;
?>
