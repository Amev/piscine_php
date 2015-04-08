#!/usr/bin/php
<?php
function ft_split($str)
{
	$str = str_replace("\t", " ", $str);
	$str = explode(" ", $str);
	$str = array_filter($str, "strlen");
	$str = implode(" ", $str);
	return $str;
}

$str = ft_split($argv[1]);
echo $str."\n";
?>
