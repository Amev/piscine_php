#!/usr/bin/php
<?php
function clean($str) {
	$search = array("\t", " ");
	$str = str_replace($search, "", $str);
    return $str;
}

function check_error($str) {
    $i = 0;
    $op = '0';
    $len = strlen($str);

    if ($str[$i] == '-')
        $i++;
    while ($i < $len && is_numeric($str[$i]))
        $i++;
    if ($i < $len && ($str[$i] == '+' || $str[$i] == '-' || $str[$i] == '/' || $str[$i] == '*' || $str[$i] == '%'))
        $op = $str[$i++];
    if ($str[$i] == '-')
        $i++;
    while ($i < $len && is_numeric($str[$i]))
        $i++;
    if ($i < $len)
        return FALSE;
    return $op;
}

if ($argc != 2)
    echo "Incorrect Parameters\n";
else
{
    $argv[1] = clean($argv[1]);
    $op = check_error($argv[1]);
    if ($op == FALSE)
        echo "Syntax Error\n";
    else
    {
        $tab = explode($op, $argv[1]);
        if ($op == '+')
            echo $tab[0] + $tab[1];
        else if ($op == '-')
            echo $tab[0] - $tab[1];
        else if ($op == '*')
            echo $tab[0] * $tab[1];
        else if ($op == '/')
            echo $tab[0] / $tab[1];
        else if ($op == '%')
            echo $tab[0] % $tab[1];
        echo "\n";
    }
}
