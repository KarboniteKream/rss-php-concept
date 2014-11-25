<?php
	session_start();

	require("database.php");
	$statement = $conn->prepare("SELECT a.id, a.title, a.url, a.author, a.date, a.content FROM Users u JOIN Unread ur ON u.id = ur.user_id JOIN Articles a ON ur.article_id = a.id JOIN Feeds f ON a.feed_id = f.id WHERE u.id = :user_id AND f.id = :id ORDER BY a.date DESC");
	$statement->bindParam(":user_id", $_SESSION["user_id"]);
	$statement->bindParam(":id", $_SESSION["location"]);
	$statement->execute();

	$articles = $statement->fetchAll(PDO::FETCH_OBJ);
	$data = array();

	foreach($articles as $article)
	{
		$data[] = array("id" => $article->id, "title" => $article->title, "url" => $article->url, "author" => $article->author, "date" => date("Y-m-d", strtotime($article->date)), "content" => $article->content);
	}

	echo json_encode($data, JSON_UNESCAPED_UNICODE);

	$statement = null;
	$conn = null;
?>
