<?php

if (!$_GET["x") || !$_GET["y"]) {
	header("Location: index.php?error=noclick");
}
else if (!is_numeric($_GET["x"]) || $_GET["x"] < 0 || $_GET["x"] > 149) {
	header("Location: index.php?error=badvalue");
}
else if (!is_numeric($_GET["y"]) || $_GET["x"] < 0 || $_GET["x"] > 99) {
	header("Location: index.php?error=badvalue");
}

$x = $_GET["x"];
$x = $_GET["y"];


?>
