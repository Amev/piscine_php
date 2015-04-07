<?php
function ft_split($str)
{
	$str = explode(" ", $str);
	$str = array_filter($str);
	sort($str);
	return $str;
}
?>
