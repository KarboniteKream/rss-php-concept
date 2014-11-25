<?php
	session_start();

	require("database.php");
	$folder = $_POST["folder"] == "" ? null : $_POST["folder"];

	$statement = $conn->prepare("UPDATE Subscriptions SET folder = :folder WHERE user_id = :user_id AND feed_id = :feed_id");
	$statement->bindParam(":folder", $folder);
	$statement->bindParam(":user_id", $_SESSION["user_id"]);
	$statement->bindParam(":feed_id", $_POST["feed_id"]);
	$statement->execute();

	$statement = null;
	$conn = null;
?>
