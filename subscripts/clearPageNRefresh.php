<?php

	require_once('../Functions.php');
	require_once('../class/Post.php');

	extract($params = $_GET); // page, onpage, minlikes, glogin, site
	$homeRef = 
		$site == '1001mem' ? 'gop1001mem' : 
		($site == 'memebase' ? 'memebase' : '');
	
	Functions::switchDatabase($site);
	
	$tmpPosts = Post::getPostsFromDb($params, $params['site']);

	$strValues = '(0, 0)';
	foreach ($tmpPosts as $post) $strValues .= ',('.$post['id'].', 0)';
	$sql = 'INSERT IGNORE INTO user_'.$glogin.' VALUES '.$strValues.';';
	mysql_query($sql);

	print($sql);
	
	$backRest = $homeRef.'?minlikes='.$minlikes.'&onpage='.$onpage.'&glogin='.$glogin.'&page='.$page;
	header('Location: /'.$backRest);

?>

