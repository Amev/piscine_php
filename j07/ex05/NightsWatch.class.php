<?php

class NightsWatch {

	private $_gardes = array();

	public function recruit($postulent) {
	
		if (is_a($postulent, "IFighter")) {
			$this->gardes[] = $postulent;
		}
		return;
	}

	public function fight() {
	
		foreach ($this->gardes as $garde) {
			$garde->fight();
		}
		return;
	}
}

?>
