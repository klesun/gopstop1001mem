<?php
	$rooting = file_get_contents('rooting.php');
	for ($i = 4851; $i >= 0; --$i) {
		$cont = file_get_contents('cheezburgerPages/page'.$i.'.html');	
		file_put_contents('cheezburgerPagesPHP/page'.$i.'.php', $cont.$rooting);
		if ($i % 100 == 0) print($i.PHP_EOL);
	}
