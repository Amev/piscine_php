<?php

session_start();

if ($_SESSION["loggued_on_user"] === "") {
	header("Location: .");
}
date_default_timezone_set("Europe/Paris");

$file = "../private/chat";
if (file_exists($file)) {
	
	$fd = fopen($file, "r");
	$flock = flock($fd, LOCK_EX);
	$content = file_get_contents($file);
	$flock = flock($fd, LOCK_UN);
	fclose($fd);
	$tab = unserialize($content);

	foreach ($tab as $elem) {
		
		echo date("[H:i]");
		echo " <b>".$elem["login"]."</b>: ".$elem["msg"]."<br />\n";
	}
}

?>
