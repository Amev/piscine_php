<?php

session_start();

if ($_SESSION["loggued_on_user"] === "") {
	header("Location: .");
}
date_default_timezone_set("Europe/Paris");

?>

<!DOCtYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Chat box</title>
    </head>
    <body>
        <?php

        $file = "../private/chat";
        if (file_exists($file)) {
			$fd = fopen($file, "r");
        	$flock = $flock($fd, LOCK_EX);
        	$content = file_get_contents($file);
        	$flock = $flock($fd, LOCK_UN);
        	fclose($fd);
        	$tab = unserialize($content);

        	foreach ($tab as $elem) {
            	$heure = date("[H:i]");
            	echo " <b>".$elem["login"]."</b>: ".$elem["msg"]."<br />";
        	}
		}

        ?>
    </body>
</html>
