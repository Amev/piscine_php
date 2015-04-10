<?php

function auth($login, $passwd) {
	$hash = "";
	$content = "";
	$tab = array();
	$file = "../private/passwd";

	$hash = hash("whirlpool", $passwd);
	$content = file_get_contents($file);
	$tab = unserialize($content);
	foreach ($tab as $elem) {
		if ($elem["login"] === $login && $elem["passwd"] === $hash)
			return TRUE;
	}
	return FALSE;
}

?>
