<?php
	if(isset($_POST["email"]) == true)
	{
		require("database.php");

		$statement = $conn->prepare("SELECT email FROM Users WHERE email = :email");
		$statement->bindParam(":email", $_POST["email"]);
		$statement->execute();

		if($statement->rowCount() != 0)
		{
			echo "ERR";
		}
		else
		{
			echo "OK";
		}

		$statement = null;
		$conn = null;
	}
?>
