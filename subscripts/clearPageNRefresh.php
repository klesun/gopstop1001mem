<?php

	require_once('../_conf.php');
	require_once('../class/Post.php');
	
	extract($params = $_GET); // page, onpage, minrate, glogin

	$tmpPosts = Post::getPostsFromDb($params);

	$strValues = '(0)';
	foreach ($tmpPosts as $post) $strValues .= ',('.$post['id'].')';
	$sql = 'INSERT IGNORE INTO user_'.$glogin.' VALUES '.$strValues.';';
	mysql_query($sql);

	$backRest = '?minrate='.$minrate.'&onpage='.$onpage.'&glogin='.$glogin.'&page='.$page;
	header('Location: /'.$backRest);

?>

