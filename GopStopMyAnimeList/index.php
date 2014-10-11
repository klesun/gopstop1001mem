<head><meta charset="utf-8" /></head>
<pre>
<?php
/*ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

// создаем оба ресурса cURL
$ch1 = curl_init();
$ch2 = curl_init();

// устанавливаем URL и другие соответствующие опции
curl_setopt($ch1, CURLOPT_URL, "http://lxr.php.net/");
curl_setopt($ch1, CURLOPT_HEADER, 0);
curl_setopt($ch2, CURLOPT_URL, "http://www.php.net/");
curl_setopt($ch2, CURLOPT_HEADER, 0);

//создаем набор дескрипторов cURL
$mh = curl_multi_init();

//добавляем два дескриптора
curl_multi_add_handle($mh,$ch1);
curl_multi_add_handle($mh,$ch2);

$active = null;
//запускаем дескрипторы
do {
    $mrc = curl_multi_exec($mh, $active);
} while ($mrc == CURLM_CALL_MULTI_PERFORM);

print_r($mh);
print('Сча войду в рисковый цикол');
while ($active && $mrc == CURLM_OK) {
    if (curl_multi_select($mh) == -1) {
		usleep(100);
	}
	do {
		$mrc = curl_multi_exec($mh, $active);
		print_r($active);
	} while ($mrc == CURLM_CALL_MULTI_PERFORM);
}

//закрываем все дескрипторы
curl_multi_remove_handle($mh, $ch1);
curl_multi_remove_handle($mh, $ch2);
curl_multi_close($mh);

print('Готово какбэ');
*/
/*
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://www.myanimelist.net");
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "postvar1=value1&postvar2=value2&postvar3=value3");

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

// further processing ....
print(($server_output).' ');*/

$strSearch = 'huj';

//  $url = "http://www.myanimelist.net";
//  $ch = curl_init();
//  curl_setopt($ch, CURLOPT_HEADER, 0);
//  curl_setopt($ch, CURLOPT_VERBOSE, 0);
//  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//  curl_setopt($ch, CURLOPT_URL, $url);
//  $response = curl_exec($ch);
//  curl_close($ch);
  
$response =  file_get_contents('http://myanimelist.net/manga/308/Eden_no_Hana/userrecs');
  
  print($response);

?>
