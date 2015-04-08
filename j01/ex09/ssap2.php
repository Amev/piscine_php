#!/usr/bin/php
<?php
function tolower($c)
{
	$ascii = ord($c);
	if ($ascii >= 65 && $ascii <= 90)
		$ascii = $ascii + 32;
	return chr($ascii);
}
function cmp_modif($a, $b)
{
	$i = 0;
	if ($a == $b)
		return 0;
	while ($a[$i] && $a[$i] == $b[$i])
		$i++;
	$a = tolower($a[$i]);
	$b = tolower($b[$i]);
	$a = ord($a);
	$b = ord($b);
	if ($a >= 48 && $a <= 57)
		$a = $a + 1000;
	else if ($a < 97 || $a > 122)
		$a = $a + 10000;
	if ($b >= 48 && $b <= 57)
		$b = $b + 1000;
	else if ($b < 97 || $b > 122)
		$b = $b + 10000;
	return ($a < $b) ? -1 : 1;
}
$i = 1;
$len = 0;
$tab = array();

while ($i < $argc)
	$tab = array_merge($tab, explode(" ", $argv[$i++]));
$tab = array_filter($tab, "strlen");
usort($tab, "cmp_modif");
$i = 0;
$len = count($tab);
while ($i < $len)
	echo $tab[$i++]."\n";
?>
