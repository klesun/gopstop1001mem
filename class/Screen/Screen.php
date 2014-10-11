<?php

require_once realpath($_SERVER["DOCUMENT_ROOT"]).'/Functions.php';
require_once realpath($_SERVER["DOCUMENT_ROOT"]).'/class/Post.php';

abstract class Screen {
    const SITE_ID = -1;

    const DISLIKE = -1;
    const VERY_DISLIKE = -2;
    const SOSO = -127;
    const ZAGIS = 66;
    const NOT_WORTH = -128;
    const LIKE = 1;
    const VERY_LIKE = 2;
    const BAYAN = 3; // БУДЕТ ПРИПЛЮСОВЫВАТЬСЯ К ОРИГИНАЛУ КАК ОДИН ЛАЙК (а если не понравилось, ЖАЛИ БЫ НЕ СТОИТ ВНИМАНИЯ

    protected $params;

    protected $login; 
    protected $page = 0;
    protected $onpage = 20;
    protected $minlikes = 1100;

    protected $posts = array();
    // id, likes null as likes for 1001mem
    // id, likes, dislikes for memebase;	id * 256 = src

    protected $watchedIdList;

    public function getHtml() {
	return ''.
	    $this->getNavigationDivHtml().'<br />'.
	    $this->getPostsHtml().
	    $this->getClearButtonHtml().'<br />'.
	    $this->getNavigationDivHtml().'<br />'.
		$this->getFooter();
    }

    public function Screen($params) {
		Functions::showErrors();
		Functions::switchDatabase($this->getSiteName());

		$this->page    = ($t =	$params['page'])   ? $t	: $t = 0;    $params['page']    = $t;	
		$this->minlikes = ($t =	$params['minlikes'])? $t : $t = 1100; $params['minlikes'] = $t;
		$this->onpage  = ($t =	$params['onpage']) ? $t	: $t = 20;   $params['onpage']  = $t;
		$this->login   =		$params['glogin'];

		$this->params = $params;

		if ($this->login) {
			if (!mysql_num_rows(mysql_query('SHOW TABLES LIKE "user_'.$this->login.'";'))) {
				mysql_query('CREATE TABLE user_'.$this->login.' (watchedPostId INT UNIQUE, rate TINYINT);');
			}
		}
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
		return ''.
			'<div id="navigationDiv">'.
			'<a href = "/subscripts/clearPageNRefresh.php'.$this->getConstantRest().($this->page).'&site='.static::getSiteName().'">'.
				'Прочитано!'.
			'</a>'.
			'</div>';
    }

    private function getPostsHtml() {
		$this->posts = Post::getPostsFromDb($this->params, static::getSiteName());
		$return = '';
		foreach ($this->posts as $post) {
			$id = $post['id'];
			$return .= ''.
			'<div id="postDiv">'.
				static::getPostInfoHtml($post).
				'<img src="'.static::getImgUrl($post).'" /><br /><br />'.

				'<table><tr>'.	// лайки, дизлайки и т.п.
				'<td> <a href="javaScript:void(0);" id="VERY_LIKE'.$id.'" '.
					'onclick="sendRate('.$id.','.self::VERY_LIKE.',\''.$this->login.'\', \''.static::getSiteName().'\')">VERY_LIKE</a> </td>'.
				'<td> <a href="javaScript:void(0);" id="like'.$id.'" '.
					'onclick="sendRate('.$id.','.self::LIKE.',\''.$this->login.'\', \''.static::getSiteName().'\')">like</a> </td>'.
				'<td> <a href="javaScript:void(0);" id="ZAGIS'.$id.'" '.
					'onclick="sendRate('.$id.','.self::ZAGIS.',\''.$this->login.'\', \''.static::getSiteName().'\')">Копипаст</a> </td>'.
				'<td> <a href="javaScript:void(0);" id="SOSO'.$id.'" '.
					'onclick="sendRate('.$id.','.self::SOSO.',\''.$this->login.'\', \''.static::getSiteName().'\')">Так себе</a> </td>'.
				'<td> <a href="javaScript:void(0);" id="dislike'.$id.'" '.
					'onclick="sendRate('.$id.','.self::DISLIKE.',\''.$this->login.'\', \''.static::getSiteName().'\')">Хреновенько</a> </td>'.
				'<td> <a href="javaScript:void(0);" id="VERY_DISLIKE'.$id.'" '.
					'onclick="sendRate('.$id.','.self::VERY_DISLIKE.',\''.$this->login.'\', \''.static::getSiteName().'\')">Очень плохо</a> </td>'.
				'<td> <a href="javaScript:void(0);" id="NOT_WORTH'.$id.'" '.
					'onclick="sendRate('.$id.','.self::NOT_WORTH.',\''.$this->login.'\', \''.static::getSiteName().'\')">Не стоит внимания</a> </td>'.

				'</tr></table>'.

			'</div><br />';
		}

		return $return;
    }

	protected function getFooter()
	{
		return '<center><a href="../subscripts/gimmeGraph.php'.Functions::paramsToRest($this->getGraphParams()).'">График</a></center>';
	}

    private function getConstantRest() {
		return ''.
			'?minlikes='.$this->minlikes.
			'&glogin='.$this->login.
			'&onpage='.$this->onpage.
			'&page=';
    }

    public function setPage($page) {
		$this->page = $page;
		$this->params['page'] = $page;
    }

    public static function getGraph($params) {
		$refik = '../subscripts/gimmeGraph.php'.Functions::paramsToRest($params);
		return('<img src = "'.$refik.'" />');
    }

//	public static function getMarkOnGraph() { // костылёк,пока что хардкожу уже готовый график...
//		$refik = '../subscripts/gimmeGraph.php'.Functions::paramsToRest($params);
//		return('<img src = "'.$refik.'" />');
//    }

    abstract protected static function getImgUrl($postRow);
    abstract protected static function getPostInfoHtml($postRow);
    abstract protected static function getSiteName();

    abstract protected function getGraphParams();
}

?>