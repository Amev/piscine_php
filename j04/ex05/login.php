<?php

session_start();
include "auth.php";

if (!$_POST["login"] || !$_POST["passwd"])
	echo "ERROR\n";
if ($_POST["login"] === "" || $_POST["passwd"] === "")
	echo "ERROR\n";
else {
	if (auth($_POST["login"], $_POST["passwd"]) === TRUE) {
		$_SESSION["loggued_on_user"] = $_POST["login"];
	}
	else {
		$_SESSION["loggued_on_user"] = "";
		echo "ERROR\n";
		header("Location: .");
		return ;
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Chat</title>
	</head>
	<body>
		<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
		<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>
	</body>
</html>
