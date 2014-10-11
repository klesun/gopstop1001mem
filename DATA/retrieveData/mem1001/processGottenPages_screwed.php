<pre>
<?php

include 'class.htmlParser.php';

$html = file_get_contents('test.html');
$parser = new htmlParser($html);
$ar = $parser->toArray();
print_r($ar);

/*
class Tag {
    public $src;
    public $subtags;
    public $tagName;
    public $hasBody = TRUE;
    
    function Tag($src, $tagName) {
	$this->tagName = $tagName;
	$this->src = $src;
	$this->subtags = $this->getSubtags();
    }
    
    function getSubtags() {
	print('Begin subtagging'.PHP_EOL);
	print('Cur. tag name: '.$this->tagName.PHP_EOL);
	print('Begin: '); self::charov($this->src, 0);
	print('End: '); self::charov($this->src, strlen($this->src)-10);
	$subtags = array();
	$src = &$this->src;
	$pos = 0;
	while ($pos < strlen($src)) {
	    $hasBody = TRUE;
	    while($src{$pos} != '<') {
		//debug
		if ($pos >= strlen($src)) throw new Exception;
		++$pos;
	    }
	    $nameStart = ++$pos;
	    if ($src{$nameStart} == '!') {
		$hasBody = FALSE;
		if ($src{$pos+1} == '-' && $src{$pos+2} == '-') {
		    $pos += 3;
		    while   (!(	$src{$pos-3} == '-' && 
				$src{$pos-2} == '-' &&
				$src{$pos-1} == '>')) ++$pos;
		    continue;
		}
	    }
	    while($src{$pos} != '>' || $src{$pos-1} == '\\') ++$pos;
	    $nameEnd = $pos-1;
	    if ($src{$nameEnd} == '/') {$hasBody = FALSE; --$nameEnd;}
	    $nameLength = $nameEnd - $nameStart + 1;
	    $tagName = substr($src, $nameStart, $nameLength);
	    $bodyStart = ++$pos;
	    
	    if ($hasBody) $opening = 1; else $opening = 0;
	    while ($opening) {
		
		while($src{$pos} != '<' || $src{$pos-1} == '\\') {
		    // debug
		    if ($pos >= strlen($src)) throw new Exception;
		    ++$pos;
		}
		++$pos;
		if ($src{$pos} == '/') {
		    --$opening;
		    while($src{$pos} != '>' || $src{$pos-1} == '\\') ++$pos;
		    ++$pos;
		} elseif ($src{$pos} == '!') {
		    while($src{$pos} != '>' || $src{$pos-1} == '\\') ++$pos;
		    ++$pos;
		} else {
		    $canHaveBody = (self::canHaveBody($src, $pos));
		    while($src{$pos} != '>' || $src{$pos-1} == '\\') ++$pos;
		    if ($src{$pos-1} == '/' || !$canHaveBody) {
			++$pos;
		    } else {
			++$opening;
			++$pos;
		    }
		}
	    }
	    $body = substr($src, $bodyStart, $pos-$bodyStart);
	    
	    $this->subtags[] = new Tag($body, $tagName);
	}	
	return $subtags;
    }
    
    private static function charov($src, $pos) {
	for ($i = 0; $i < 10; ++$i) {
	    print($src{$pos+$i});
	}
	print(PHP_EOL);
    }
    
    private static function canHaveBody($src, $pos) {
	$bodyless = array('area', 'base', 'br', 'col', 'command', 'embed', 
	    'hr', 'img', 'input', 'link', 'meta', 'param', 'source');
	foreach($bodyless as $tagName) {
	    $len = strlen($tagName);
	    $target = substr($src, $pos, $len);
	    if ($target == $tagName) {
		$charik = $src{$pos+$len};
		if ($charik == ' ' || $charik == '/' || $charik == '>') return FALSE;
	    }
	}
	return TRUE;
    }
}

//$src = file_get_contents('thesePages/page20.html');
$src = file_get_contents('test.html');
$mainTag = new Tag($src, 'mainTag');
 */