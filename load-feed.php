<?php
	session_start();
	require("database.php");

	$status = array("", "");

	if($_SESSION["location"] == "unread")
	{
		$statement = $conn->prepare("SELECT a.id, a.title, a.url, a.author, a.date, a.content FROM Unread l JOIN Articles a ON l.article_id = a.id WHERE user_id = :user_id");
		$statement->bindParam(":user_id", $_SESSION["user_id"]);
		$statement->execute();
		$status[1] = "unread";
	}
	else if($_SESSION["location"] == "liked")
	{
		$statement = $conn->prepare("SELECT a.id, a.title, a.url, a.author, a.date, a.content FROM Liked l JOIN Articles a ON l.article_id = a.id WHERE user_id = :user_id");
		$statement->bindParam(":user_id", $_SESSION["user_id"]);
		$statement->execute();
		$status[0] = "liked";
	}
	else if($_SESSION["location"] == "all")
	{
		$statement = $conn->prepare("SELECT l.user_id AS liked, u.user_id AS unread, a.id, a.title, a.url, a.author, a.date, a.content FROM Subscriptions s JOIN Feeds f ON s.feed_id = f.id JOIN Articles a ON f.id = a.feed_id LEFT JOIN Liked l ON a.id = l.article_id LEFT JOIN Unread u ON a.id = u.article_id WHERE s.user_id = :user_id ORDER BY a.date DESC LIMIT 25");
		$statement->bindParam(":user_id", $_SESSION["user_id"]);
		$statement->execute();
	}
	else
	{
		$statement = $conn->prepare("SELECT a.id, a.title, a.url, a.author, a.date, a.content FROM Users u JOIN Unread ur ON u.id = ur.user_id JOIN Articles a ON ur.article_id = a.id JOIN Feeds f ON a.feed_id = f.id WHERE u.id = :user_id AND f.id = :id ORDER BY a.date DESC");
		$statement->bindParam(":user_id", $_SESSION["user_id"]);
		$statement->bindParam(":id", $_SESSION["location"]);
		$statement->execute();
		$status[1] = "unread";
	}

	$articles = $statement->fetchAll(PDO::FETCH_OBJ);
	$data = array();

	foreach($articles as $article)
	{
		if($_SESSION["location"] == "all")
		{
			$status[0] = $article->liked != NULL ? "liked" : "";
			$status[1] = $article->unread != NULL ? "unread" : "";
		}

		$data[] = array("status" => $status, "id" => $article->id, "title" => $article->title, "url" => $article->url, "author" => $article->author, "date" => date("Y-m-d", strtotime($article->date)), "content" => $article->content);
	}

	echo json_encode($data, JSON_UNESCAPED_UNICODE);

	$statement = null;
	$conn = null;
?>
