<?php

session_start();

if ($_GET["submit"] && $_GET["submit"] === "OK") {
	$_SESSION["login"] = $_GET["login"] ? $_GET["login"] : "";
	$_SESSION["passwd"] = $_GET["passwd"] ? $_GET["passwd"] : "";
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Une session</title>
	</head>
	<body>
		<form method="get" action="index.php">
			<label for="login">Identifiant: </label>
			<input type="text" name="login" id="login" value=<?php echo '"'.$_SESSION['login'].'"' ?>/></br></br>
			<label for="passwd">Password: </label>
			<input type="password" name="passwd" id="passwd" value=<?php echo '"'.$_SESSION['passwd'].'"' ?>/></br></br>
			<input type="submit" name="submit" value="OK" />
		</form>
	</body>
</html>
