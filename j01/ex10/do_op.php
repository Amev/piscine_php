#!/usr/bin/php
<?php
function clean($str) {
	$search = array("\t", " ");
	$str = str_replace($search, "", $str);
    return $str;
}

$i = 1;

if ($argc != 4)
    echo "Incorrect Parameters\n";
else
{
    while ($i++ < 4)
        $argv[$i - 1] = clean($argv[$i - 1]);
    if ($argv[2] == "+")
        echo $argv[1] + $argv[3];
    else if ($argv[2] == "-")
        echo $argv[1] - $argv[3];
    else if ($argv[2] == "*")
        echo $argv[1] * $argv[3];
    else if ($argv[2] == "/")
        echo $argv[1] / $argv[3];
    else if ($argv[2] == "%")
        echo $argv[1] % $argv[3];
    echo "\n";
}
?>
