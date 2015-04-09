#!/usr/bin/php
<?php

function recup_img($html) {
	$match = array();
	preg_match_all("#<img.*>#", $html, $match);
	print_r($match);
}

$curl = curl_init($argv[1]);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

if ($argc > 1 && $curl !== FALSE) {
	$html = curl_exec($curl);
	if (!$html) {
		echo "Invalid url\n";
		return;
	}
	recup_img($html);
}

curl_close($curl);

?>
