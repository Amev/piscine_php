#!/usr/bin/php
<?php
while (1)
{
	echo "Entrez un nombre: ";
	$buff = fgets(STDIN);
	$buff = trim($buff);
	if (feof(STDIN) == TRUE)
	{
		echo "\n";
		break;
	}
	if (is_numeric($buff) == FALSE)
		echo "'$buff' n'est pas un chiffre\n";
	else if ($buff % 2 == 0)
		echo "Le chiffre $buff est Pair\n";
	else
		echo "Le chiffre $buff est Impair\n";
}
?>
