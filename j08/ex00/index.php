<?php



?>

<!DOCTYPE HTML>

<html>
	<head>
		<meta charset="utf-8" />
		<title>My game</title>
		<style>

			div {
				background-color: white;
				color: white;
				text-align: center;
			}

			<?php

			if ($_GET && $_GET["error"]) {
				echo ".msgbox {background-color: #FF9F8E; color: red;}" . PHP_EOL;
			}

			?>
		</style>
	</head>
	<body>
		<div class="msgbox">
			<?php

			if ($_GET && $_GET["error"]) {
				if ($_GET["error"] === "noclick") {
					echo '<p>You do not have click on a case, plz select one</p>' . PHP_EOL;
				}
				else if ($_GET["error"] === "badvalue") {
					echo "<p>Good try but no, you can't enter an invalide value :)</p>" . PHP_EOL;
				}
			}
			else {
				echo "<p>I have no message for you !</p>" . PHP_EOL;
			}

			?>
		</div>
		<div class="new_game">
			<form method="post" action="get_zone.php">
				<input type="submit" name="new" value="New" />
			</form>
		</div>
		<table>
			<?php
			$y = 0;
			while ($y < 100) {

				$x = 0;
				echo "<tr>" . PHP_EOL;
				while ($x < 150) {

					echo '<td><a href="get_zone.php?x=' . $x . '&y=' . $y;
					echo '><div class="clickable"></div></a></td>' . PHP_EOL;
					$x++;
				}
				echo "</tr>". PHP_EOL;
				$y++;
			}
			?>
		</table>
	</body>
</html>
