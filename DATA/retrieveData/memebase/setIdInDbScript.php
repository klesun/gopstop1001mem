<?php

mysql_connect('localhost', 'root', 'Irakliy1');
$sql = 'USE memebase;';
mysql_query($sql);

$sql = 'SELECT * FROM posts_raw;';
$answ = mysql_query($sql);
$lastLength = 0;
$i = 0;
$posts = array();
while ($row = mysql_fetch_assoc($answ)) {
	$src = $row['src'];
	$start = 29;
	$end = strpos($src, '/', $start);
	$length = $end - $start;
	$id = substr($row['src'], $start, $length);
	if ($length != $lastLength || $i % 1000 == 0) {
		print($src.PHP_EOL.'\''.$id.'\''.PHP_EOL.doubleval($id).PHP_EOL.PHP_EOL);
		$lastLength = $length;
	}
	$row['id'] = doubleval($id);
	$row['src'] = '\''.substr($row['src'], $start, $length).'\'';
	$posts[] = $row;
	++$i;
}
print($i.PHP_EOL);
$ids = array();
foreach ($posts as $key => $row)
{
    $ids[$key] = $row['id'];
}
array_multisort($ids, SORT_ASC, $posts);

$bracArr = array();
foreach($posts as $post) {
	$bracArr[] = '('.$post['src'].','.$post['likes'].','.$post['dislikes'].')';
}
$valuesStr = implode(',', $bracArr);

$sql = 'ALTER TABLE posts AUTO_INCREMENT = 1;';
mysql_query($sql);

$sql = 'INSERT INTO posts (src,likes,dislikes) VALUES '.$valuesStr.';';
print($sql);
mysql_query($sql);
