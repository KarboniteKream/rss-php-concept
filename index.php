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
					<div id="reader">
						<article>
							<div class="date">2014-10-28</div>
							<h2><a href="http://lwn.net/Articles/618331/rss">Release for CentOS-6.6 i386 and x86_64</a></h2>
							<div class="author">by <b>ris</b> (LWN.net)</div>
							<div class="content">
								<p>CentOS 6.6 has been released.  "There are many fundamental changes in this release, compared with the past CentOS-6 releases, and we highly recommend everyone study the upstream Release Notes as well as the upstream Technical Notes about the changes and how they might impact your installation. (See the 'Further Reading' section of the [<a href="http://wiki.centos.org/Manuals/ReleaseNotes/CentOS6.6">CentOS release notes</a>])."</p>
							</div>
							<div class="action-bar">
								<span class="open-popup" target-popup="#register">Like</span>
							</div>
						</article>
						<article>
							<div class="date">2014-10-24</div>
							<h2><a href="http://xkcd.com/1438/">Houston</a></h2>
							<div class="author">by <b>Randall Munroe</b> (XKCD)</div>
							<div class="content">
								<img src="http://imgs.xkcd.com/comics/houston.png" title="'Oh, hey Mom. No, nothing important, just at work.'" alt="'Oh, hey Mom. No, nothing important, just at work.'">
							</div>
							<div class="action-bar">
								<span class="open-popup" target-popup="#register">Like</span>
							</div>
						</article>
						<article>
							<div class="date">2014-10-22</div>
							<h2><a href="https://www.archlinux.org/news/changes-to-intel-microcodeupdates/">Changes to Intel microcode updates</a></h2>
							<div class="author">by <b>Thomas Bächler</b>&nbsp; (Arch Linux)</div>
							<div class="content">
								<p>Microcode on Intel CPUs is no longer loaded automatically, as it needs to be loaded very early in the boot process. This requires adjustments in the bootloader. If you have an Intel CPU, please follow <a href="https://wiki.archlinux.org/index.php/Microcode#Enabling_Intel_Microcode_Updates">the instructions in the wiki</a>.</p>
							</div>
							<div class="action-bar">
								<span class="open-popup" target-popup="#register">Like</span>
							</div>
						</article>
						<article>
							<div class="date">2014-08-21</div>
							<h2><a href="https://www.archlinux.org/news/reorganization-of-vim-packages/">Reorganization of Vim packages</a></h2>
							<div class="author">by <b>Thomas Dziedzic</b> (Arch Linux)</div>
							<div class="content">
								<p>The Vim suite of packages has been reorganized to better provide advanced features in the standard vim package, and to split the CLI and GUI versions; the new packages are:</p>
								<ul>
									<li>vim-minimal: identical to the previous vim package</li>
									<li>vim: now includes all the features from gvim which includes the python, lua, and ruby interpreters, without GTK/X support</li>
									<li>vim-python3: same as the above for gvim-python3</li>
									<li>gvim: same as before</li>
									<li>gvim-python3: same as before</li>
									<li>vim-runtime: same as before</li>
								</ul>
							</div>
							<div class="action-bar">
								<span class="open-popup" target-popup="#register">Like</span>
							</div>
						</article>
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
