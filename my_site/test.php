<?php
	function getTrue() {
		for ($i = 13; $i < 10000000; ++$i);
		return true;
	}

	if (getTrue() || TRUE) print('iririr');
