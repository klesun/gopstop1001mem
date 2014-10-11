<?php

require_once realpath($_SERVER["DOCUMENT_ROOT"]).'/class/Screen/Screen.php';

class Mem1001Screen extends Screen {
    const SITE_ID = 1;

    public function getHtml() {
	    return 
		    //$this->getGraph($this->getGraphParams());
		    parent::getHtml();
    }

    protected static function getSiteName() {
	    return '1001mem';
    }

    protected static function getImgUrl($postRow) {
	    $folder = (ceil($postRow['id'] / 1000)) * 1000;
	    return 'http://img.1001mem.ru/posts/'.$folder.'/'.$postRow['id'].'.jpg';
    }

    protected static function getPostInfoHtml($postRow) {
	    return	'id: <a href="http://1001mem.ru/p'.$postRow['id'].'">'.$postRow['id'].'</a><br />'.
			    'likes: <font color="#00ff00">'.$postRow['likes'].'</font><br /> ';
    }

    protected function getGraphParams() {
	    return array('site' => '1001mem', 'maxZavis' => 1500, 'minZavis' => -10, 'cenaDeleniyaZavis' => 250, 'cenaDeleniyaIzmen' => 500000);
    }
}

?>