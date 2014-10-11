<pre>
<?php
	$str_json = file_get_contents('php://input');
	$posts = json_decode($str_json);	// src, likes, dislikes
	
	mysql_connect('localhost', 'root', 'Irakliy1');
    $sql = 'USE memebase;';
    mysql_query($sql);
	
	// making sql string from array
	$bracketArr = array();
	foreach ($posts as $post) {
		$post[0] = '\''.$post[0].'\'';
		$bracketArr[] = '('.implode(',', $post).')';
	}
	$values = implode(',', $bracketArr);
	
	$sql = 'INSERT IGNORE INTO posts VALUES '.$values.';';
	mysql_query($sql);

	mysql_query(' INSERT INTO queries VALUES ("'.$sql.'"); ');
