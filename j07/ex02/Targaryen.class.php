<?php

class Targaryen {

	public function resistsFire() {

		return FALSE;
	}

	public function getBurned() {

		if (static::resistsFire() == FALSE)
			return "burns alive";
		else
			return "emerges naked but unharmed";
	}
}

?>
