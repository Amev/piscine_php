<?php



?>

<!DOCTYPE HTML>

<html>
	<head>
		<meta charset="utf-8" />
		<title>My game</title>
		
	</head>
	<body>
		<table>
			<?php
			$y = 0;
			while ($y < 100) {

				$x = 0;
				echo "<tr>" . PHP_EOL;
				while ($x < 150) {

					echo '<td><a href="get_zone.php?x=' . $x . '/y=' . $y;
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
