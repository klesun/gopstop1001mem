<?php
class Post {
    public static function getPostsFromDb($params) {
	extract($params); //page, onpage, minrate, glogin
	$auth = $glogin ? 1 : 0;
	$usrTbl = 'user_'.$glogin;
	$sql = 	' SELECT posts.* FROM posts '.
		    ($auth ? 'LEFT JOIN '.$usrTbl.' ON (posts.id = '.$usrTbl.'.watchedPostId) ' : '').
			' WHERE rating >= '.$minrate.
			($auth ? ' AND '.$usrTbl.'.watchedPostId IS NULL ' : '').
			' LIMIT '.$page*$onpage.', '.$onpage.' ; ';
	$return = getListBySql($sql);
	return $return;
    }
}
