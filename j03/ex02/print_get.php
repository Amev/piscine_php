<?php

if ($_GET) {
	$i = 0;
	$keys = array_keys($_GET);
	$len = count($keys);

	while ($i < $len) {
		$key = $keys[$i++];
		echo $key.": ".$_GET[$key]."\n";
	}
}

?>
