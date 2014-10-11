
function sendRate(id, rate, login, siteName) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState === 4) {
			if (xmlhttp.status === 200) {
					alert('Послание от сервера: ' + xmlhttp.responseText);
			} else {
					alert('Нет коннекта ' + xmlhttp.status);
			}
		}
	}
	xmlhttp.open('GET', '/subscripts/addRateToDb.php?id='+id+'&rate='+rate+'&login='+login+'&site='+siteName, true);
	xmlhttp.send();
}
