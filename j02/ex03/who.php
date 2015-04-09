#!/usr/bin/php
<?php

$i = 0;
$j = 0;
$len = 0;
$array = array();

date_default_timezone_set("Europe/Paris");
$str = file_get_contents("/var/run/utmpx");
$str = substr($str, 1256);
while ($str) {
	$array[$i++] = unpack("A256user/A4id/A32tty/ipid_t/ientry/I2time/a256host/I16rest", $str);
	$str = substr($str, 628);
}

sort($array);
while ($j < $i) {
	if ($array[$j]["entry"] == 7) {
		echo $array[$j]["user"];
		$k = 0;
		$len = strlen($array[$j]["user"]);
		while ($k++ < 9 - $len)
			echo " ";
		echo $array[$j]["tty"];
		$k = 0;
		$len = strlen($array[$j]["tty"]);
		while ($k++ < 9 - $len)
			echo " ";
		echo strftime("%b %e %R \n", $array[$j]["time1"]);
	}
	$j++;
}

?>
