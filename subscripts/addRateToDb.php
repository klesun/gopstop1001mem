<?php
	require_once '../Functions.php';

	Functions::switchDatabase($_GET['site']);

    if (($login = $_GET['login'])	&& 
	    ($id = $_GET['id'])			&&
	    ($rate = $_GET['rate'])) 
	{	
		$sql = 'INSERT INTO user_'.$login.' VALUES ('.$id.','.$rate.')  ON DUPLICATE KEY UPDATE '.
				'user_'.$login.'.rate = VALUES(user_'.$login.'.rate);';
		print( mysql_query($sql) ? 'всё ок '.$rate : ('база не принимает... сучка '.$sql));
    } 
    print("\nВот и всё, что я могу сказать");