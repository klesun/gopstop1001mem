<head><meta charset="utf-8" /></head>
<?php

require_once('../Functions.php');

class Post {
	private static function getWhereClause($params, $siteName) {
		if ($siteName == '1001mem') {
			return ' AND likes >= '.$params['minlikes'];
		} elseif ($siteName == 'memebase') {
			return ' AND likes >= '.$params['minlikes'];
		}
	}
	
    public static function getPostsFromDb($params, $siteName) {
		print(date("Y-m-d-h-i-s",time()).' Начинаем вытаскивать посты '.'<br />');
		extract($params); //page, onpage, minlikes, glogin
		if ($auth = ($params['glogin'] ? 1 : 0)) {
			$usrTbl = 'user_'.$glogin;
			$sql = 'SELECT * FROM '.$usrTbl.' ;';
			$idByKeyList = getListBySql($sql); $idList = array();
			foreach ($idByKeyList as $idByKey) $idList[] = $idByKey['watchedPostId'];
			$toSql = '('.implode(',',$idList).')';
		}
		print(date("Y-m-d-h-i-s",time()).' Вытащили данные пользователя '.'<br />');
		$postList = array();
		
		do {
		    $sql = 	' SELECT posts.* FROM posts '.
				    ' WHERE 1 '. 
					    self::getWhereClause($params, $siteName).
				    ($auth? ' AND NOT id IN '.$toSql : '').
				    ' LIMIT '.$page*$onpage.', '.$onpage.' ; ';
		    $postList = getListBySql($sql);
		    
		} while (!count($postList) && $page-- > 0);
		
		print(date("Y-m-d-h-i-s",time()).' Вычислили посты, не прочитанные пользователем: '.'<br />');
		return $postList;
    }
}
