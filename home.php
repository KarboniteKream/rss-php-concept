<?php
	if(session_start() == true)
	{
		if(isset($_SESSION["user_id"]) == false)
		{
			$root = $_SERVER["HTTP_HOST"];
			header("Location: http://$root");
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
	<body>
		<header>
			<h1><a href="/">kream.io</a><span class="version"> rss</span></h1>
			<nav>
				<ul>
					<li><a href="/home.html" class="active">Home</a></li>
					<li><a href="/settings.html">Settings</a></li>
					<li><a href="/help.html">Help</a></li>
					<li><a href="sign_out.php">Sign out</a></li>
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
					<div id="menu">
						<ul>
							<li><a id="home" href="/home.html">Home</a></li>
							<li><a id="unread" href="/unread.html">Unread <span class="badge">7</span></a></li>
							<li><a id="liked" href="/liked.html">Liked</a></li>
							<li><a id="all" href="/all.html">All articles</a></li>
						</ul>
					</div>
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
