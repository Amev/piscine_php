#!/usr/bin/php
<?php

function ft_replace_link($str, $i) {
	$i++;
	while ($str[$i] != '>')
		$i++;
	$i++;
	$tmp = substr($str, $i);
	while (strlen($tmp) && !preg_match("#^</a>#", $tmp)) {
		while ($str[$i] != '<') {
			$ascii = ord($str[$i]);
			if ($ascii >= 97 && $ascii <= 122) {
				$str[$i] = chr($ascii - 32);
			}
			$i++;
		}
		$tmp = substr($str, $i);
		if (preg_match("#^</a>#", $tmp))
			break;
		while ($str[$i] != '>')
			$i++;
		$tmp = substr($str, $i - 1);
	}
	return ($str);
}

function ft_replace_title($str, $i) {
	$tmp = substr($str, $i);
	while (!preg_match("#^title=\".*\"#s", $tmp)) {
		$i++;
		$tmp = substr($str, $i);
	}
	$i += 7;
	while ($str[$i] != '"') {
		$ascii = ord($str[$i]);
		if ($ascii >= 97 && $ascii <= 122) {
			$str[$i] = chr($ascii - 32);
		}
		$i++;
	}
	return ($str);
}

$i = 0;

if ($argc > 1) {
	$str = file_get_contents($argv[1]);
	$len = strlen($str);
	while ($i < $len) {
		$tmp = substr($str, $i);
		if (preg_match("#^<a.*>.*</a>#s", $tmp)) {
			$str = ft_replace_link($str, $i);
		}
		if (preg_match("#^<[^>]* title=\".*\".*>#s", $tmp)) {
			$str = ft_replace_title($str, $i);
		}
		$i++;
	}
	echo $str;
}

?>
