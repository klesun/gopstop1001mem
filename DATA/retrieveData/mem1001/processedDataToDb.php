<?php

mysql_connect('localhost', 'root', 'Irakliy1');

$src = file_get_contents('result.txt');
$i = 0;
$pos = 0;
$arik = array();
$len = strlen($src);
while ($pos < $len) {
    $nextSpace = strpos($src, ' ', $pos);
    $imgsrc = substr($src, $pos, $nextSpace-$pos);
    $pos = $nextSpace+1;

    $nextSpace = strpos($src, ' ', $pos);
    $id = substr($src, $pos, $nextSpace-$pos);
    $pos = $nextSpace+1;

    $nextEnter = strpos($src, "\n", $pos);
    $rate = substr($src, $pos, $nextEnter-$pos);
    $pos = $nextEnter+1;

    $arik[] = array($id, $rate);

    //print('['.$arik[0].']'.'['.$arik[1].']'.'['.$arik[2].']'.PHP_EOL);

    //if (++$i % 3000 == 0) print('Getting array: '.$i.PHP_EOL);
}

$sql = 'USE 1001mem;';
mysql_query($sql);

$i = 0;
$sql = 'INSERT INTO posts (id,likes) VALUES (0,0),';
foreach ($arik as $post) {
    $sql .= '('.$post[0].','.$post[1].'),';
    if (++$i % 10000 == 0) {
	print('Adding to Db: '.$i.PHP_EOL);
	$sql .= '(0,0);';
	mysql_query($sql);
	$sql = 'INSERT IGNORE INTO posts (id,likes) VALUES (0,0),';
    }
}
$sql .= '(0,0);';
mysql_query($sql);
$sql .= 'DELETE FROM posts WHERE id = 0;';
mysql_query($sql);
