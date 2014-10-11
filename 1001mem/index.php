<html>
<head><meta charset='utf-8'>
<link rel="stylesheet" href="/style_main.css">
<script src="/main_scripts.js"></script>
</head>
<body>

<h3><a href='../memebase'>==> Посты, спизженные с Memebase <==</a></h3>

<center><font color="orange">
    <h1>Легендарные из 1001mem.ru</h1>
</font></center>

<?php
			ini_set('display_startup_errors',1);
			ini_set('display_errors',1);
			error_reporting(-1);
require_once('../class/Screen/Mem1001Screen.php');

IF (!count($_GET)){
    header('Location: ?minlikes=1100&glogin=&onpage=20&page=0');
    die;}
$screen = new Mem1001Screen($_GET);
print($screen->getHtml());

?>

</body>
</html>
