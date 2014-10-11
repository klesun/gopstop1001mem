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
		file_put_contents('thesePages/page'.$pageNo.'.html', file_get_contents('http://1001mem.ru/new/'.$pageNo));
		--$pageNo;
	}
}

function getLastPage() {
    $l = -1;
    $r = 1000000;
    print($no_page);
    while ($r-$l > 1) {
		$m = (int)(($l+$r) / 2);
		print($m.' ');
		$cur_page = file_get_contents('http://1001mem.ru/new/'.$m);
		if (strlen($cur_page) > 20000) { // page exist
			$l = $m;
		} else {
			$r = $m;
		}
	}
	
    return $l;
}
