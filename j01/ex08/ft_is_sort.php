<?php
function ft_is_sort($tab)
{
	$i = 0;
	$len = count($tab);
	$sorted = $tab;
	sort($sorted);

	while ($i < $len)
	{
		if ($tab[$i] != $sorted[$i])
			return FALSE;
		$i++;
	}
	return TRUE;
}
?>
