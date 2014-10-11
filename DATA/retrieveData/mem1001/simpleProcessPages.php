<?php

file_put_contents('result.txt', '');

$posts = array();
$i = 0;

while ($src = file_get_contents('thesePages/page'.$i.'.html')) {
    while ($pos = strpos($src, '<article') !== FALSE) {
	$pos = strpos($src, '<article');
	$src = substr($src, $pos+14);
	$pos = strpos($src, '"');
	$id = substr($src, 0, $pos);
	$pos = strpos($src, '<span>');
	$src = substr($src, $pos+6);
	$pos = strpos($src, '<');
	$rate = substr($src, 0, $pos);
	$pos = strpos($src, '<img');
	$src = substr($src, $pos+10);
	$pos = strpos($src, '"');
	$imgLink = substr($src, 0, $pos);

	file_put_contents('result.txt', $imgLink.' '.$id.' '.$rate.PHP_EOL, FILE_APPEND);
    }
    ++$i;
    if ($i % 100 == 0) print((memory_get_usage()/1000000).' '.$i.PHP_EOL);
}
