<?php	// остановился на maxZavis - сделать с ним что-нибудь, чтобы вынести получение (У на графике) тоже в функцию
	
require_once '../Functions.php';

class GraphDrawer {
    private $params = array('izmen' => 'id', 'zavis' => 'likes', 'width' => 1000, 'height' => 500, 'minZavis' => 0);
	protected $image; protected $height; protected $width; protected $izmen; protected $zavis; protected $site;
	protected $minIzmenValue; protected $maxIzmenValue; protected $maxZavis; protected $minZavis = 0;

    private function GraphDrawer($params) {
	    foreach ($params as $key => $value) {
		    if ($value) $this->params[$key] = $value;
	    }

		$this->image = imagecreate($this->params['width'], $this->params['height']+($this->params['zavis2'] ? 50 : 0));

		$this->height = $this->params['height']; $this->width = $this->params['width']; 
		$this->izmen = $this->params['izmen']; $this->zavis = $this->params['zavis']; 
		$this->site = $this->params['site'];
    }

	public static function make($params)
	{
		$obj = new self($params);

		if (!$obj->getSite()) throw new Exception('No \'site\' param specified for Graph');
		Functions::switchDatabase($obj->getSite());

		$obj->minIzmenValue = mysql_fetch_object(mysql_query(' SELECT min('.$obj->izmen.') as minIzmen FROM posts; '))->minIzmen;
		$obj->maxIzmenValue = mysql_fetch_object(mysql_query(' SELECT max('.$obj->izmen.') as maxIzmen FROM posts; '))->maxIzmen;

		return  $obj;
	}

    public function gimmeImage() {
		$params = $this->params;
		$width=$params['width'];$height=$params['height'];$maxZavis=$params['maxZavis'];$zavis=$params['zavis'];$zavis2=$params['zavis2'];$izmen=$params['izmen'];

		$height -= 10; // для цен деления
		$width -= 20;
		imagecolorallocate($this->image, 255, 255, 255);
		$color = imagecolorallocate($this->image, 0, 0, 255);
		$redColor = imagecolorallocate($this->image, 255, 0, 0);
		$cyanColor = imagecolorallocate($this->image, 0, 255, 255);
		$greenColor = imagecolorallocate($this->image, 0, 255, 0);

		$totalCountRow = mysql_fetch_assoc(mysql_query(' SELECT count(*) as count FROM posts; '));
		$totalCount = $totalCountRow['count'];

		$answ = mysql_query(' SELECT * FROM posts; ');

		//$this->drawGrid();
		$divCount = 10;

		for ($i = 0; $i < $totalCount; $i += 1) { // $i += 1
			$row = mysql_fetch_assoc($answ);	if (!$row) break;
			$x = $this->getGraphX($row[$izmen], 20);
			$y = $row[$zavis]*$height/$maxZavis;
			$y2 = $row[$zavis2] ? $row[$zavis2]*$height/$maxZavis : NULL;
			if ($y*$height/$maxZavis > $height) $y = $height; 
			imageSetPixel($this->image, $x, $height - $y, $color);
			if ($y2 !== NULL) imageSetPixel($this->image, $x, $height+$y2+10, $greenColor);
		}

		Header("Content-type: image/jpeg");
		imagejpeg($this->image);
		imagedestroy($this->image);
    }

	private function getGraphX($izmenValue, $indentForMarks)
	{
		return 
				($izmenValue - $this->minIzmenValue)
				* 
				($this->width - $indentForMarks)
				/
				($this->maxIzmenValue - $this->minIzmenValue)
				;
	}

	private function drawGrid() // TODO: write bleatj 
	{
		$cenaIzmen = $this->params['cenaDeleniyaIzmen'];
		$cenaZavis = $this->params['cenaDeleniyaZavis'];
		for ($i = 0; $i*$cenaZavis < $divCount; ++$i) { // horizontal
			$y = $height/$divCount * $i;
			$zavisValue = $max/$divCount*$i;
			imageline($this->image, 0, $y, $width+20, $y, $cyanColor);
			imagestring($this->image, 1, $width, $height - $y, $zavisValue, $redColor);
		}
		for ($i = 0; $i < $divCount; ++$i) {
			$x = $width/$divCount * $i;
			$izmenValue = $minIzmen + round(($maxIzmen-$minIzmen)/$divCount*$i);
			imageline($this->image, $x, 0, $x, $height+20, $cyanColor);
			imagestring($this->image, 1, $x, $height, $izmenValue, $redColor);
		}
	}

	public function getSite()
	{
		return $this->site;
	}
}

//Functions::showErrors();
$gimmer = GraphDrawer::make($_GET);	// site, izmen, zavis, razmit, width, height, max, min
$gimmer->gimmeImage();