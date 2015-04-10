<?php

session_start();
include "auth.php";

function iframe() {
	echo '<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>';
	echo '<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>';
}

if (!$_POST["submit"] || !$_POST["login"] || !$_POST["passwd"])
	echo "ERROR\n";
if ($_POST["submit"] !== "OK" || $_POST["login"] === "" || $_POST["passwd"] === "")
	echo "ERROR\n";
else {
	if (auth($_POST["login"], $_POST["passwd"]) === TRUE) {
		$_SESSION["loggued_on_user"] = $_GET["login"];
		iframe();
	}
	else {
		$_SESSION["loggued_on_user"] = "";
		echo "ERROR\n";
		header("Location: .");
	}
}

?>
