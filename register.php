<?php
	require("database.php");
	$statement = $conn->prepare("INSERT INTO Users (real_name, email, password) VALUES (:real_name, :email, :password)");

	$salt = substr(strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), "+", "."), 0, 22);
	$salt = sprintf("$2a$%02d$", 10) . $salt;
	$hash = crypt($_POST["password"], $salt);

	$statement->bindParam(":real_name", $_POST["real_name"]);
	$statement->bindParam(":email", $_POST["email"]);
	$statement->bindParam(":password", $hash);

	if($statement->execute() == true)
	{
		if(session_start() == true)
		{
			$_SESSION["user_id"] = $conn->lastInsertId();
		}

		echo "OK";
	}

	$statement = null;
	$conn = null;
?>
