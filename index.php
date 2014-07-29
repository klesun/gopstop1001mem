<html>
<head><meta charset='utf-8'>
<style type="text/css">
body {
    color: white;
    background-color: black }
a {
    color: lightblue;
}
#postDiv {
    background-color: #111111;
    width: 600px;
    margin: 0 auto;
    text-align:center; 
}
#navigationDiv {
    background-color: #222222;
    width: 600px;
    margin: 0 auto;
    text-align:center; 
}
</style>
</head>
<body>
	
<center><font color="orange">
    <h1>Легендарные из 1001mem.ru</h1>
</font></center>

<?php

/*
// Кнопка оценивания
9
8
7
6 - ничётак
5 - нестоитвнимания
4 - лучшенечитать
3
2
1
0 - убиритинахуй
*/

// Кнопка "Незаслуженные тысячи лайков"... наверное. Может, это и будет почти синонимом просто низкой оценки... нет. Оценки ставятся за контент... Может мотивировать их внатури ставить минусы усерднее, когда видя, что лайки незаслуженные

// Кнопка "Уже было на прошлых страницах", "Поле для Id"
// Кнопка "Уже забаянило (когда одна и та же тема уже 100500 постов подряд)", можно тоже указывать Id, через запятую

// Поиск по содержанию (аля, исключить все картинки со словом лайк*)

// Кнопка "Прочитал всё с первой страницы до сюда" будет хранить в кеше, на серваке по Ip и, чтоб совсем уж наверняка, на серваке по логину на gmail

// график оценка от Id, прозрачность пиксела зависит от количества лайков на постах в нём. Отношение лайков к дислайкам можно будет менять. Вообще график каждый может сделать индивидуальный, по фильтрам пользователя - вот тебе и решение проблем. Его можно будет сделать масштабируемым, но при каждом масштабировании, сударь, извольте обращаться на сервер, потому что от вашего жаваскрыпта меня воротит. 

// во... сделать "относительную оценку" рядом с абсолютной и посмотреть, сильно ли отличаются. Относительная оценка - это сто постов влево, сто постов вправо и отношение средней оценки к оценке этого поста (надеюсь, ты понимаешь, что не надо каждый раз пересчитывать 200 постов). Кстати, коичество постов для замерения относительной оценки тоже можно сделать регулируемым. Бляха, я это пишу дольше, чем писал бы программу
// стовлевостовправо

require_once('./_conf.php');
require_once('./class/Post.php');

class Screen {
	protected $params;
    
	protected $gmailLogin; 
	protected $page = 0;
	protected $onpage = 20;
	protected $minrate = 500;

	protected $posts = array();
	// id, rating, imgref
	
	protected $navigationDivHtml;
	protected $clearButtonHtml;
	
	protected $watchedIdList;
	
	public function getHtml() {
		return ''.
			$this->navigationDivHtml.'<br />'.
			$this->getPostsHtml().
			$this->clearButtonHtml.'<br />';
	}
	
	public function Screen($params) {
		
		$this->page    = ($t =	$params['page'])   ? $t	: $t = 0;   $params['page']    = $t;	
		$this->minrate = ($t =	$params['minrate'])? $t : $t = 500; $params['minrate'] = $t;
		$this->onpage  = ($t =	$params['onpage']) ? $t	: $t = 20;  $params['onpage']  = $t;
		$this->gmailLogin    =	$params['glogin'];
		
		$this->params = $params;
		
		if ($this->gmailLogin) {
		    if (!mysql_num_rows(mysql_query('SHOW TABLES LIKE "user_'.$this->gmailLogin.'";'))) {
			mysql_query('CREATE TABLE user_'.$this->gmailLogin.' (watchedPostId INT);');
		    }
		}
		$this->posts = Post::getPostsFromDb($this->params);
		$this->navigationDivHtml = $this->getNavigationDivHtml();
		$this->clearButtonHtml = $this->getClearButtonHtml();
	}
	
	private function getNavigationDivHtml() {
	    return ''.
		    '<div id="navigationDiv">'.
			'<div>'.
			    '<a href = "'.$this->getConstantRest().($this->page+1).'">'.
				'Вперёд!'.
			    '</a>'.
			'</div>'.
			($this->page > 0 ?
			'<div>'.
			    '<a href = "'.$this->getConstantRest().($this->page-1).'">'.
				'Назад?'.
			    '</a>'.
			'</div>' : '').
		    '</div>';
	}
	
	private function getClearButtonHtml() {
	    return ''.	// послать на сервер, что типа прочитал
		    '<div id="navigationDiv">'.	// пока не работает
			'<a href = "/subscripts/clearPageNRefresh.php'.$this->getConstantRest().($this->page).'">'.
			    'Прочитано!'.
			'</a>'.
		    '</div>';
	}
	
	private function getPostsHtml() {
		$return = '';
		foreach ($this->posts as $post) {
			$return .= ''.
			    '<div id="postDiv">'.
				'id: <a href="http://1001mem.ru/p'.$post['id'].'">'.$post['id'].'</a><br />'.
				'likes: <font color="#00ff00">'.$post['rating'].'</font><br /> '.
				'<img src="'.$post['imgref'].'" alt="1001mem.ru" /><br /><br />'.
			    '</div><br />';
		}
		return $return;
	}
	
	private function getConstantRest() {
	    return ''.
		    '?minrate='.$this->minrate.
		    '&glogin='.$this->gmailLogin.
		    '&onpage='.$this->onpage.
		    '&page=';
	}
}

$screen = new Screen($_GET);
print($screen->getHtml());

?>

</body>
</html>
