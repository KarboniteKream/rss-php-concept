<?php
	require("database.php");

	$statement = $conn->prepare("SELECT id, password FROM Users WHERE email = :email");
	$statement->bindParam(":email", $_POST["email"]);
	$statement->execute();
	$user = $statement->fetch(PDO::FETCH_OBJ);

	if(crypt($_POST["password"], $user->password) == $user->password)
	{
		if(session_start() == true)
		{
			if($_POST["remember_me"] == "true")
			{
				$cookie = substr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), 0, 22);

				require("database.php");
				$statement = $conn->prepare("UPDATE Users SET cookie = :cookie WHERE id = :id");
				$statement->bindParam(":cookie", $cookie);
				$statement->bindParam(":id", $user->id);

				if($statement->execute() == true)
				{
					setcookie("remember_me", $cookie, time() + (3600 * 24 * 14));
				}
				
				$statement = null;
				$conn = null;
			}
			$_SESSION["user_id"] = $user->id;
			$_SESSION["home"] = "home";
		}

		echo "OK";
	}
	
	$statement = null;
	$conn = null;
?>
