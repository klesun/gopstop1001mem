<?php
/*
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);
*/
	mysql_connect('localhost', 'root', 'Yuzefa');
	$sql = 'USE mem1001;';
	mysql_query($sql);

	function getListBySql($sql) {
		$answ = mysql_query($sql);
		$list = array();
		$i = 0;
		while ($row = mysql_fetch_assoc($answ)) {
			foreach ($row as $key => $value) $list[$i][$key] = $value;
			++$i;
		}
		return $list;
	}
	
?>