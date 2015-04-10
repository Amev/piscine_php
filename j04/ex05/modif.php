<?php

if ($_POST["submit"] === "OK") {
	if ($_POST["login"] === "" || $_POST["newpw"] === "" || $_POST["oldpw"] === "") {
		echo "ERROR\n";
	}
	else {
		$len = 0;
		$tab = array();
		$data = array();
		$file = "../private/passwd";

		$content = file_get_contents($file);
		if (!$content || $content == FALSE)
			echo "ERROR\n";
		$tab = unserialize($content);
		$old = hash("whirlpool", $_POST["oldpw"]);
		foreach ($tab as $elem) {
			if ($elem["login"] === $_POST["login"]) {
				if ($elem["passwd"] != $old) {
					echo "ERROR\n";
					return ;
				}
				break ;
			}
			$len++;
		}
		$data["login"] = $_POST["login"];
		$data["passwd"] = hash("whirlpool", $_POST["newpw"]);
		$tab[$len] = $data;
		$content = serialize($tab);
		if (file_put_contents($file, $content) === FALSE)
			echo "ERROR FILE_PUT_CONTENTS\n";
		else
			echo "OK\n";
	}
}

?>
