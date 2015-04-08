#!/usr/bin/php
<?php
$i = 1;
$len = 0;
$tab = array();

while ($i < $argc)
	$tab = array_merge($tab, explode(" ", $argv[$i++]));
$tab = array_filter($tab, "strlen");
sort($tab);
$i = 0;
$len = count($tab);
while ($i < $len)
	echo $tab[$i++]."\n";
?>
