<?php
	session_start();

	require("database.php");
	$statement = $conn->prepare("SELECT s.folder, f.id, f.name, f.icon, u.unread FROM Subscriptions s JOIN Feeds f ON s.feed_id = f.id LEFT JOIN (SELECT a.feed_id, COUNT(a.feed_id) AS unread FROM Unread JOIN Articles a ON article_id = a.id WHERE user_id = 1 GROUP BY feed_id) AS u ON f.id = u.feed_id WHERE s.user_id = :user_id ORDER BY s.folder, f.name");
	$statement->bindParam(":user_id", $_SESSION["user_id"]);
	$statement->execute();
	$feeds = $statement->fetchAll(PDO::FETCH_OBJ);

	if(count($feeds) > 0)
	{
		$idx = 0;

		echo "<ul class='connected sortable'>\n";
		while($feeds[$idx]->folder == NULL && $idx < count($feeds))
		{
			printf("<li><a feed='%s' href='javascript:;' class='%s'", $feeds[$idx]->id, $feeds[$idx]->id == $_SESSION['location'] ? 'active' : '');
			if($feeds[$idx]->icon != NULL)
			{
				$icon = base64_encode($feeds[$idx]->icon);
				printf("style='background-image: url(data:image/png;base64,%s)'", $icon);
			}
			printf(">%s</a> ", $feeds[$idx]->name);
			if($feeds[$idx]->unread != NULL)
			{
				printf("<span class='badge'>%s</span>", $feeds[$idx]->unread);
			}
			printf("</li>");
			$idx++;
		}
		echo "</ul>\n<ul>";

		$folder = NULL;
		for(; $idx < count($feeds); $idx++)
		{
			if($folder != $feeds[$idx]->folder)
			{
				if($folder != NULL)
				{
					echo "<li class='empty-li' />\n</ul>\n</li>\n";
				}

				$folder = $feeds[$idx]->folder;
				printf("<li class='folder'>\n<input type='checkbox' id='folder-toggle' />\n<label for='folder-toggle'>%s</label>\n<ul class='connected sortable'>\n", $feeds[$idx]->folder);
			}

			printf("<li><a feed='%s' href='javascript:;' class='%s'", $feeds[$idx]->id, $feeds[$idx]->id == $_SESSION['location'] ? 'active' : '');
			if($feeds[$idx]->icon != NULL)
			{
				$icon = base64_encode($feeds[$idx]->icon);
				printf("style='background-image: url(data:image/png;base64,%s)'", $icon);
			}
			printf(">%s</a> ", $feeds[$idx]->name);
			if($feeds[$idx]->unread != NULL)
			{
				printf("<span class='badge'>%s</span>", $feeds[$idx]->unread);
			}
			printf("</li>");
		}
		echo "<li class='empty-li' />\n</ul>\n</li>\n</ul>";
	}

	$statement = null;
	$conn = null;
?>
