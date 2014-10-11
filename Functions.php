<?php

	function getListBySql($sql) {
		$answ = mysql_query($sql);
		$list = array();
		$i = 0;
		while ($row = mysql_fetch_assoc($answ)) {
			foreach ($row as $key => $value) $list[$i][$key] = $value;
			++$i;
			if ($i % 10000 == 0) print($i.' Mem. '.(memory_get_usage()/1000000).PHP_EOL);
		}
		return $list;
	}

	class Functions {

		public static function switchDatabase($site) {
			$sql = 'USE ';
			if ($site == '1001mem') {
				$sql .= '1001mem';
			} elseif ($site == 'memebase') {
				$sql .= 'memebase';
			}
			$sql .= ';';
			mysql_query($sql);
		}
		
		public static function getListBySql($sql) {
			$answ = mysql_query($sql);
			$list = array();
			$i = 0;
			while ($row = mysql_fetch_assoc($answ)) {
				foreach ($row as $key => $value) $list[$i][$key] = $value;
				++$i;
				if ($i % 10000 == 0) print($i.' Mem. '.(memory_get_usage()/1000000).PHP_EOL);
			}
			return $list;
		}
		
		public static function showErrors() {
			ini_set('display_startup_errors',1);
			ini_set('display_errors',1);
			error_reporting(-1);
		}
		
		public static function paramsToRest($params) {
			$rest = '?';
			foreach($params as $key => $value) {
				$rest .= '&'.$key.'='.$value;
			}
			return $rest;
		}
	}
