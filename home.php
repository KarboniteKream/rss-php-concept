<?php
	if(session_start() == true)
	{
		if(isset($_SESSION["user_id"]) == false)
		{
			$root = $_SERVER["HTTP_HOST"];
			header("Location: http://$root");
			exit();
		}

		$_SESSION["location"] = "settings";
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
	<body>
		<header>
			<h1><a href="/">kream.io</a><span class="version"> rss</span></h1>
			<nav>
				<ul>
					<li><a href="/home.php" class="active">Home</a></li>
					<li><a href="/settings.php">Settings</a></li>
					<li><a href="/help.html">Help</a></li>
					<li><a href="util.php?function=sign-out">Sign out</a></li>
				</ul>
			</nav>
		</header>
		<div id="main">
			<div id="sidebar">
				<span id="new-subscription" class="button-primary block">New subscription</span>
				<div id="add-subscription">
					<form action="javascript:;" method="post">
						<fieldset>
							<button type="submit" tabindex="2">Add</button>
							<input type="url" placeholder="subscription URL" tabindex="1"/>
						</fieldset>
					</form>
				</div>
				<div id="sidebar-content">
				</div>
			</div>
			<div id="content">
				<div class="header">
					<span class="button-primary">Refresh</span>
					<span class="button-secondary">Settings</span>
					<span class="button-secondary open-popup" target-popup="#unsubscribe">Unsubscribe</span>
					<h2 id="feed-name"></h2>
				</div>
				<div id="reader">
					<div class="home-left">
						<h2 class="notice">You have 7 unread articles.</h2>
						<div id="widgets">
							<img src="http://imgs.xkcd.com/comics/time.png" title="The end." alt="The current time is unknown." />
						</div>
					</div>
					<div id="featured" class="home-right">
					</div>
				</div>
			</div>
		</div>
		<div id="overlay" onclick="hideOverlay()"></div>
		<div id="unsubscribe" class="popup">
			<div class="header">
				<span class="button-secondary" onclick="hideOverlay()">&times;</span>
				<h3>Unsubscribe</h3>
			</div>
			<form action="javascript:unsubscribe()" method="post">
				<fieldset>
					<span id="form-question">Are you sure you want to unsubscribe from FEED?</span>
					<button type="submit" tabindex="2">Yes</button>
					<button id="unsubscribe-button" type="button" class="button-secondary" onclick="hideOverlay()" tabindex="1">No</button>
				</fieldset>
			</form>
		</div>
	</body>
</html>
