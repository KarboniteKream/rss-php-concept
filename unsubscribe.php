<?php
	session_start();
	require("database.php");

	$statement = $conn->prepare("DELETE FROM Subscriptions WHERE user_id = :user_id AND feed_id = :feed_id");

	$statement->bindParam(":user_id", $_SESSION["user_id"]);
	$statement->bindParam(":feed_id", $_SESSION["location"]);
	$statement->execute();

	$_SESSION["location"] = "home";

	$statement = null;
	$conn = null;
?>
