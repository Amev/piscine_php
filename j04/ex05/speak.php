<?php

session_start();

function put_content($file, $tab) {

	$fd = fopen($file, "w");
	$content = serialize($tab);
	$flock = flock($fd, LOCK_EX);

	if (file_put_contents($file, $content) === FALSE) {
		return FALSE;
	}

	$flock = flock($fd, LOCK_UN);
	fclose($fd);

	return TRUE;
}

function get_content($file) {

	if (file_exists($file)) {
		$content = file_get_contents($file, LOCK_EX);
		$tab = unserialize($content);
		return $tab;
	}
	return FALSE;
}

if ($_SESSION["loggued_on_user"] === "") {
	echo "ERROR\n";
	header("Location: .");
	return ;
}

if ($_POST && $_POST["msg"] && $_POST["msg"] !== "") {

	$msg = array("login" => $_SESSION["loggued_on_user"], "time" => time(), "msg" => $_POST["msg"]);
	$file = "../private/chat";
	$tab = get_content($file);
	$tab[] = $msg;

	if (put_content($file, $tab) === FALSE) {

		echo "ERROR\n";
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Messqge box</title>
		<script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
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
			<input type="text" name="msg" id="msg" autofocus/></br></br>
		</form>
	</body>
</html>
