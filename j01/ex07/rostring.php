#!/usr/bin/php
<?php
function ft_split($str)
{
	$str = explode(" ", $str);
	$str = array_filter($str);
	$str = implode(" ", $str);
	$str = explode(" ", $str);
	return $str;
}

$str = ft_split($argv[1]);
$len = count($str);
$i = 1;
while ($i < $len)
	echo $str[$i++]." ";
if ($str[0])
	echo $str[0]."\n";
?>
