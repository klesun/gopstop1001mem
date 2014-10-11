<head>
    <meta charset='utf-8'>
</head>
<pre>
<?php

print('Привет, гандон'.PHP_EOL);
main();

function main() {
    $pageNo = getLastPage();
    
    while ($pageNo > -1) {
		print($pageNo.PHP_EOL);
		file_put_contents('cheezburgerPages/page'.$pageNo.'.html', file_get_contents('http://memebase.cheezburger.com/page/'.$pageNo));
		--$pageNo;
	}
}

function getLastPage() {
    $null_page = file_get_contents('http://memebase.cheezburger.com/page/10000000');
    $cur_page = $null_page;
    $null_length = strlen($null_page);
    $l = -1;
    $r = 1000000;
    while ($r-$l > 1) {
		$m = (int)(($l+$r) / 2);
		$cur_page = file_get_contents('http://memebase.cheezburger.com/page/'.$m);
			print($m.' '.strlen($cur_page).PHP_EOL);
		if (strlen($cur_page) - $null_length < 10) { // page not exist
			$r = $m;
		} else {
			$l = $m;
		}
    }
    print('Нашли типа '.$m.' '.strlen($cur_page).PHP_EOL);
    
    return $l;
}
