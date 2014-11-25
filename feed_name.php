<?php
	session_start();

	require("database.php");
	if($_SESSION["location"] == "home")
	{
		echo "Home";
	}
	else if($_SESSION["location"] == "unread")
	{
		echo "Unread";
	}
	else if($_SESSION["location"] == "liked")
	{
		echo "Liked";
	}
	else if($_SESSION["location"] == "all")
	{
		echo "All articles";
	}
	else
	{
		$statement = $conn->prepare("SELECT name FROM Feeds WHERE id = :id");
		$statement->bindParam(":id", $_SESSION["location"]);
		$statement->execute();

		$feed = $statement->fetch(PDO::FETCH_OBJ);
		echo $feed->name;
	}

	$statement = null;
	$conn = null;
?>
