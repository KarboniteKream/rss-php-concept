<?php
	session_start();
	require("database.php");

	$statement = $conn->prepare("SELECT a.id, a.title, a.url, a.author, a.date, a.content FROM Liked l JOIN Articles a ON l.article_id = a.id GROUP BY l.article_id ORDER BY COUNT(l.article_id) DESC");
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
