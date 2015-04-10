<?php

session_start();
include "auth.php";

if ($_GET["login"] === "" || $_GET["passwd"] === "")
	echo "ERROR\n";
else {
	if (auth($_GET["login"], $_GET["passwd"]) === TRUE) {
		$_SESSION["loggued_on_user"] = $_GET["login"];
		echo "OK\n";
	}
	else {
		$_SESSION["loggued_on_user"] = "";
		echo "ERROR\n";
	}
}

?>
