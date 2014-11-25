<?php
	if(session_start() == true)
	{
		if(isset($_SESSION["user_id"]) == true)
		{
			$_SESSION["location"] = "home";
			header("Location: home.php");
			exit();
		}
		else if(isset($_COOKIE["remember_me"]) == true)
		{
			require("database.php");
			$statement = $conn->prepare("SELECT id FROM Users WHERE cookie = :cookie");
			$statement->bindParam(":cookie", $_COOKIE["remember_me"]);
			$statement->execute();

			$_SESSION["user_id"] = $statement->fetch(PDO::FETCH_OBJ)->id;

			$statement = null;
			$conn = null;

			$_SESSION["location"] = "home";
			header("Location: home.php");
			exit();
		}
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<title>kream</title>
		<meta charset="UTF-8" />
		<link href="/resources/kream.png" rel="icon" type="image/png" />
		<link href="/style.css" rel="stylesheet" type="text/css" />
		<script src="//code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="/html.sortable.min.js" type="text/javascript"></script>
		<script src="/script.js" type="text/javascript"></script>
	</head>
	<body id="index">
		<header>
			<h1><a href="/">kream.io</a><span class="version"> rss</span></h1>
			<nav>
				<ul>
					<li><span class="button-secondary open-popup" target-popup="#register">Register</span></li>
					<li><span class="button-primary open-popup" target-popup="#sign-in">Sign in</span></li>
				</ul>
			</nav>
		</header>
		<main>
			<div id="banner">the next-generation <span class="rss">RSS</span> reader</div>
			<div id="landing">
				<div>
					<div class="header">
						<span id="fullscreen" class="button-primary">v</span>
						<h2>Featured articles</h2>
					</div>
					<div id="featured">
					</div>
				</div>
			</div>
		</main>
		<div id="overlay" onclick="hideOverlay()"></div>
		<div id="sign-in" class="popup">
			<div class="header">
				<span class="button-secondary" onclick="hideOverlay()">&times;</span>
				<h3>Sign in</h3>
			</div>
			<form action="javascript:sign_in()" method="post">
				<fieldset>
					<input type="email" name="email" tabindex="1" placeholder="e-mail" />
					<br />
					<input type="password" name="password" tabindex="2" placeholder="password" />
					<br />
					<button type="submit" tabindex="4">Sign in</button>
					<label for="remember-me">
						<input id="remember-me" type="checkbox" tabindex="3" />
						Remember me
					</label>
				</fieldset>
			</form>
		</div>
		<div id="register" class="popup">
			<div class="header">
				<span class="button-secondary" onclick="hideOverlay()">&times;</span>
				<h3>Register</h3>
			</div>
			<form action="javascript:register()" method="post">
				<fieldset>
					<input type="text" name="real-name" placeholder="real name" />
					<br />
					<input id="new-email" type="email" name="email" placeholder="e-mail" />
					<br />
					<span id="email-registered">This email is already registered.</span>
					<br />
					<input type="password" name="password" placeholder="password" />
					<br />
					<input class="confirm-password" type="password" placeholder="confirm password" />
					<br />
					<button type="submit">Register</button>
				</fieldset>
			</form>
		</div>
	</body>
</html>
