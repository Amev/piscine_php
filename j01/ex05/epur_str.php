#!/usr/bin/php
<?php
function ft_split($str)
{
	$str = explode(" ", $str);
	$str = array_filter($str);
	$str = implode(" ", $str);
	return $str;
}

$str = ft_split($argv[1]);
echo $str."\n";
?>
