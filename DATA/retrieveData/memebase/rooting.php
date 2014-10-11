<?php
	if ($_GET['page'] < 0) die();
	if (!$_GET['page']) $_GET['page'] = 4824;
?>


<script>	
	// init
	var tester;
	var elems = document.getElementsByTagName('*'), i;
	
	for (i in elems) {
		if((' ' + elems[i].className + ' ').indexOf(' ' + 'js-vote-count' + ' ') > -1) {
			tester = elems[i];
			break;
		}
	}

	// when everything got
	function getData() {
		var posts = [];
	
		for (i in elems) {
			if((' ' + elems[i].className + ' ').indexOf(' ' + 'post-inner' + ' ') > -1) {
				var content = elems[i].children[1];	// post-asset-wrap
				content = content.children[0];		//	asset-image
				content = content.children[0];		//	post-asset-inner
				content = content.children[0];		//	js-img-link/twitter
				if (content.className == 'twitter-tweet twitter-tweet-rendered') continue;
				content = content.children[0];		//	lol-mage
				var src = content.getAttribute("src");
				
				var ratings = elems[i].children[2];	// post-body
				ratings = ratings.children[0];		//	row-fluid actions edit-hidden
				ratings = ratings.children[0];		//	span5
				ratings = ratings.children[0];		//	edit-hidden
				var dislikes = ratings.children[0];	//	js-vote-down
				dislikes = dislikes.children[0];	//	js-vote-count
				var dCount = dislikes.textContent;
												
				var likes = ratings.children[1];//	js-vote-up
				likes = likes.children[0];		//	js-vote-count
				var lCount = likes.textContent;
				
				posts.push([src, lCount, dCount]);
			}
		}
		
		// отправить в php		
		var str_json = JSON.stringify(posts);
		request = new XMLHttpRequest();
		request.onreadystatechange=function() {
			var page = <?php print($_GET['page']-1); ?>;
			window.location.replace('http://etotsajt.lv/desktop/progas/gopStop1001mem/cheezburgerPagesPHP/page'+page+'.php?page='+page);
		}
		request.open("POST", "../addFromJsToDbCheese.php", true);
		request.setRequestHeader ("Accept", "text/xml");
		request.send(str_json);
		
		
	}
	
	// waiting till loads
	var tryAgain = function() {
		if (tester.textContent === '-') {
			setTimeout(tryAgain, 1000)
			return;
		} else {
			getData();
			return;
		}
	}
	tryAgain();
	
</script>
