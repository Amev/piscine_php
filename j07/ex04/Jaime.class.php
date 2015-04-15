<?php

class Jaime extends Lannister {

	public function sleepWith($partner) {

		if (is_a($partner, "Cersei"))
			print("With pleasure, but only in a tower in Winterfell, then." . PHP_EOL);
		else
			parent::sleepWith($partner);
		return;
	}
}

?>
