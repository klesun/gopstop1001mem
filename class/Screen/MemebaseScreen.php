<?php

require_once realpath($_SERVER["DOCUMENT_ROOT"]).'/class/Screen/Screen.php';

class MemebaseScreen extends Screen {
    const SITE_ID = -1;

    public function getHtml() {
	return 
	    //$this->getGraph($this->getGraphParams());
	    parent::getHtml();
    }

    public function MemebaseScreen($params) {
	parent::__construct($params);
	if ($this->page == 0) $this->setPage(500);
    }

    protected static function getSiteName() {
	return 'memebase';
    }

    protected static function getImgUrl($postRow) {
	return 'https://i.chzbgr.com/maxW500/'.($postRow['id']*256);
    }

    protected static function getPostInfoHtml($postRow) {
	return	'likes: <font color="#00ff00">'.$postRow['likes'].'</font><br /> '.
		'dises: <font color="#00ff00">'.$postRow['dislikes'].'</font><br /> ';
    }


    protected function getGraphParams() {
	return array('site' => 'memebase', 'zavis2' => 'dislikes', 'maxZavis' => 5000, 'cenaDeleniyaZavis' => 500, 'cenaDeleniyaIzmen' => 2000000);
    }
}