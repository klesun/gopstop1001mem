<html>
<head><meta charset='utf-8'>
<link rel="stylesheet" href="/style_main.css">
<script src="/main_scripts.js"></script> 
</head>
<body>
    
<h3><a href='../1001mem'>==> Посты, спизженные с 1001mem.ru <==</a></h3>
	
<center><font color="#88ccff">
    <h1>Из Memebase с фильтрами</h1>
</font></center>

<?php

require_once('../class/Screen/MemebaseScreen.php');

IF (!count($_GET)){
    header('Location: ?minlikes=30&glogin=&onpage=20&page=200');
    die;}

$screen = new MemebaseScreen($_GET);
print($screen->getHtml());

?>
</body>
</html>
