#!/usr/bin/php
<?php
function split_value($str)
{
	$i = 0;
	$len = 0;
	$tmp = "";
	$key = $str;
	$value = $str;
	$tab = array();

	$key = strstr($str, ":", TRUE);
	$value = strstr($str, ":", FALSE);
	$tmp = $value;
	$len = strlen($value);
	while ($i < $len + 1)
		$value[$i++] = $tmp[$i];
	$tab[0] = $key;
	$tab[1] = $value;
	return $tab;
}
$i = 2;
$needed = "";
$tab = array();
$hache = array();

if ($argc > 1)
	$needed = $argv[1];
while ($i < $argc)
{
	$tab = split_value($argv[$i++]);
	$hache[$tab[0]] = $tab[1];
}
if ($hache[$needed])
	echo $hache[$needed]."\n";
?>
