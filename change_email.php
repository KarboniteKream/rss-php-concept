<?php
	session_start();
	require("database.php");

	$statement = $conn->prepare("UPDATE Users SET email = :email WHERE id = :id");
	$statement->bindParam(":email", $_POST["email"]);
	$statement->bindParam(":id", $_SESSION["user_id"]);
	$statement->execute();
?>
