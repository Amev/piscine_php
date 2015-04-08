#!/usr/bin/php
<?php

function ft_split($str) {
	$str = str_replace("\t", " ", $str);
	$str = explode(" ", $str);
	$str = array_filter($str, "strlen");
	return $str;
}

$i = 1;
$len = 0;
$tab = array();

while ($i < $argc) {
	$tmp = ft_split($argv[$i++]);
	$tab = array_merge($tab, $tmp);
}
$tab = array_filter($tab, "strlen");
sort($tab);
$i = 0;
$len = count($tab);
while ($i < $len)
	echo $tab[$i++]."\n";
?>
