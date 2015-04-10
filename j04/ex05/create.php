<?php

if ($_POST["submit"] === "OK") {
	if ($_POST["login"] === "" || $_POST["passwd"] === "") {
		echo "ERROR\n";
	}
	else {
		$len = 0;
		$tab = array();
		$data = array();
		$dir = "../private";
		$file = "../private/passwd";

		if (file_exists($dir) === FALSE) {
			if (mkdir($dir, 0755) === FALSE) {
				echo "ERROR MKDIR\n";
				return ;
			}
		}
		if (file_exists($file) === TRUE) {
			$content = file_get_contents($file);
			$tab = unserialize($content);
			foreach ($tab as $elem) {
				if ($elem["login"] === $_POST["login"]) {
					echo "ERROR\n";
					return ;
				}
				$len++;
			}
		}
		$data["login"] = $_POST["login"];
		$data["passwd"] = hash("whirlpool", $_POST["passwd"]);
		$tab[$len] = $data;
		$content = serialize($tab);
		if (file_put_contents($file, $content) === FALSE)
			echo "ERROR FILE_PUT_CONTENTS\n";
		else
			echo "OK\n";
		header("Location: .");
	}
}

?>
