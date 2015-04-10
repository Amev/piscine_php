<?php

session_start();

if ($_SESSION["loggued_on_user"] === "") {
	header("Location: .");
}
echo $_POST["msg"];
if ($_POST["msg"] && $_POST["msg"] !== "") {
	$msg = array("login" => $_SESSION["loggued_on_user"], "time" => time(), "msg" => $_POST["msg"]);
	$file = "../private/chat";
	$fd = fopen($file);
	$flock = flock($fd, LOCK_EX);
	$content = file_get_contents($file);
	$tab = unserialize($content);

	$tab[] = $msg;
	$content = serialize($tab);
	file_put_contents($file, $content);
	$flock = flock($fd, LOCK_UN);
	fclose($fd);
	echo $content."\n";
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Creation de compte</title>
		<style>
			input {
				display: inline-block;
				width: 70%;
			}
		</style>
	</head>
	<body>
		<form method="post" action="speak.php">
			<label for="msg">Votre message : </label>
			<input type="text" name="msg" id="msg" /></br></br>
		</form>
	</body>
</html>
