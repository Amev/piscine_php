#!/usr/bin/php
<?php

function month_nb($months, $search) {
	foreach ($months as $elem) {
		if (preg_match("/^".$elem."$/", $search))
			return array_search($elem, $months);
	}
	return (FALSE);
}

function clean($str) {
	$str = preg_replace("/^[ \t]+/", "", $str);
	$str = preg_replace("/[ \t]+$/", "", $str);
	$str = preg_replace("/[ \t]+/", " ", $str);
	return $str;
}

function check_format($str) {
	$split = array();

	$split = preg_split("/ /", $str);
	if (count($split) != 5)
		return FALSE;
	if (preg_match("/^[Ll]undi$|^[Mm]ardi$|^[Mm]ercredi$|^[Jj]eudi$|^[Vv]endredi$|^[Ss]amedi$|^[Dd]imanche$/", $split[0]) == 0)
		return FALSE;
	if (is_numeric($split[1]) == FALSE || $split[1] < 1 || $split[1] > 31)
		return FALSE;
	if (preg_match("/^[Jj]anvier$|^[Ff]evrier$|^[Mm]ars$|^[Aa]vril$|^[Mm]ai$|^[Jj]uin$|^[Jj]uillet$|^[Aa]out$|^[Ss]eptembre$|^[Oo]ctobre$|^[Nn]ovembre$|^[Dd]ecembre$/", $split[2]) == 0)
		return FALSE;
	if (preg_match("/^-{0,1}[0-9]+$/", $split[3]) == 0)
		return FALSE;
	if (($split[4] < 0 || $split[4] > 23) || preg_match("/^\d\d:[0-5]\d:[0-5]\d$/", $split[4]) == 0)
		return FALSE;
	return $split;
}

$i = 0;
$j = 0;
$len = "";
$year = "";
$month = "";
$tab = array();
$str = $argv[1];
$months = array("01" => "[Jj]anvier", "02" => "[Ff]evrier", "03" => "[Mm]ars", "04" => "[Aa]vril", "05" => "[Mm]ai", "06" => "[Jj]uin", "07" => "[Jj]uillet", "08" => "[Aa]out", "09" => "[Ss]eptembre", "10" => "[Oo]ctobre", "11" => "[Nn]ovembre", "12" => "[Dd]ecembre");

if ($argc > 1)
{
	$str = clean($str);
	$tab = check_format($str);
	$len = strlen($tab[3]);
	if ($tab === FALSE || $tab[3] < 0 || $len > 4)
		echo "Wrong Format\n";
	else
	{
		$month = month_nb($months, $tab[2]);
		while ($i < 4 - $len)
			$year[$i++] = '0';
		while ($i < 4)
			$year[$i++] = $tab[3][$j++];
		$year = implode("", $year);
		$str = $year.":".$month.":".$tab[1]." ".$tab[4];
		date_default_timezone_set("Europe/Paris");
		echo strtotime($str)."\n";
	}
}

?>
