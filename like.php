<?php
	session_start();
	require("database.php");

	if($_POST["liked"] == "true")
	{
		$statement = $conn->prepare("DELETE FROM Liked WHERE user_id = :user_id AND article_id = :article_id");
	}
	else
	{
		$statement = $conn->prepare("INSERT INTO Liked (user_id, article_id) VALUES (:user_id, :article_id)");
	}

	$statement->bindParam(":user_id", $_SESSION["user_id"]);
	$statement->bindParam(":article_id", $_POST["article_id"]);
	$statement->execute();

	if($_POST["liked"] == "false")
	{
		$statement = $conn->prepare("DELETE FROM Unread WHERE user_id = :user_id AND article_id = :article_id");
		$statement->bindParam(":user_id", $_SESSION["user_id"]);
		$statement->bindParam(":article_id", $_POST["article_id"]);
		$statement->execute();
	}

	$statement = null;
	$conn = null;
?>
