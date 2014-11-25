<?php
	session_start();
	require("database.php");

	$statement = $conn->prepare("DELETE FROM Liked WHERE user_id = :id");
	$statement->bindParam(":id", $_SESSION["user_id"]);
	$statement->execute();

	$statement = $conn->prepare("DELETE FROM Unread WHERE user_id = :id");
	$statement->bindParam(":id", $_SESSION["user_id"]);
	$statement->execute();

	$statement = $conn->prepare("DELETE FROM Subscriptions WHERE user_id = :id");
	$statement->bindParam(":id", $_SESSION["user_id"]);
	$statement->execute();

	$statement = $conn->prepare("DELETE FROM Users WHERE id = :id");
	$statement->bindParam(":id", $_SESSION["user_id"]);

	if($statement->execute() == true)
	{
		unset($_COOKIE["remember_me"]);
		setcookie("remember_me", NULL, -1);
		session_unset();
		$root = $_SERVER["HTTP_HOST"];
		header("Location: http://$root");
		$statement = null;
		$conn = null;
		exit();
	}
?>
