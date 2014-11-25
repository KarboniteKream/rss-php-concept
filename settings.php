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
					<li><a href="/home.php">Home</a></li>
					<li><a href="/settings.php" class="active">Settings</a></li>
					<li><a href="/help.html">Help</a></li>
					<li><a href="/sign_out.php">Sign out</a></li>
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
					<div class="header-secondary-30">
						<h2>Account</h2>
					</div>
					<h2>Settings</h2>
				</div>
				<div id="reader">
					<div id="settings-content" class="home-left">
						<div>
							<div id="general-settings">
								<form>
									<fieldset>
										<legend>Home page</legend>
										<input id="featured-home" type="checkbox" checked />
										<label for="featured-home">Show featured articles</label>
										<br />
										<input id="xkcd-time" type="checkbox" checked />
										<label for="xkcd-time">Show XKCD #1190</label>
									</fieldset>
									<fieldset>
										<legend>Appearance</legend>
										<label for="theme">Theme</label>
										<select id="theme">
											<option value="Dark">Dark</option>
											<option value="Light" selected="selected">Light</option>
										</select>
									</fieldset>
								</form>
							</div>
							<div id="user-interface">
								<form>
									<fieldset>
										<legend>Article order</legend>
										<input id="order-normal" type="radio" checked="checked" />
										<label for="order-normal">Normal (newer articles first)</label>
										<br />
										<input id="order-reverse" type="radio" />
										<label for="order-reverse">Reverse (older articles first)</label>
										<br />
									</fieldset>
									<fieldset>
										<legend>Reading preferences</legend>
										<input id="mark-read" type="checkbox" checked />
										<label for="mark-read">Mark articles as read when scrolling</label>
									</fieldset>
								</form>
							</div>
						</div>
						<div>
							<span id="save-settings" class="button-primary block">Save</span>
						</div>
					</div>
					<div id="account-content" class="home-right">
						<form id="change-email" action="javascript:changeEmail()" method="post">
							<fieldset>
								<legend>Change e-mail</legend>
								<input name="email" type="email" placeholder="new e-mail" />
								<br />
								<input class="confirm-email" type="email" placeholder="confirm e-mail" />
								<br />
								<button type="submit">Change</button>
							</fieldset>
						</form>
						<form id="change-password" action="." method="post">
							<fieldset>
								<legend>Change password</legend>
								<input type="password" placeholder="current password" />
								<br />
								<input type="password" placeholder="new password" />
								<br />
								<input class="confirm-password" type="password" placeholder="confirm password" />
								<br />
								<button type="submit">Change</button>
							</fieldset>
						</form>
						<span id="delete-account-button" class="button-red block open-popup" target-popup="#delete-account">Delete my account</span>
					</div>
				</div>
			</div>
		</div>
		<div id="delete-account" class="popup">
			<div class="header">
				<span class="button-secondary" onclick="hideOverlay()">&times;</span>
				<h3>Delete my account</h3>
			</div>
			<form id="delete-account-form" action="delete_account.php" method="post">
				<fieldset>
					<input type="password" name="password" placeholder="password" />
					<br />
					<input class="confirm-password" type="password" placeholder="confirm password" />
					<br />
					<button type="submit" class="button-red">Delete</button>
					<label>This action cannot be undone!</label>
				</fieldset>
			</form>
		</div>
		<div id="overlay"></div>
	</body>
</html>
