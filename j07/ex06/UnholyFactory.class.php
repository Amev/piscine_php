<?php

class UnholyFactory {

	private $abs_type = array();

	public function absorb($soldier) {

		if (is_a($soldier, "Fighter")) {

			$class_name = get_class($soldier);
			$class_name = strtolower($class_name);
			$class_name = $class_name === "footsoldier" ? "foot soldier" : $class_name;
			if (array_key_exists($class_name, $this->abs_type)) {

				$class_name = $class_name . ")" . PHP_EOL;
				print("(Factory already absorbed a fighter of type " .$class_name);
			}
			else {

				$this->abs_type[$class_name]++;
				$class_name = $class_name . ")" . PHP_EOL;
				print("(Factory absorbed a fighter of type " . $class_name);
			}
		}
		else {
			print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
		}

		return;
	}

	public function fabricate($type) {

		$type = strtolower($type);

		if ($this->abs_type[$type]) {

			if ($type === "foot soldier")
				$fighter = new FootSoldier();
			else if ($type === "archer")
				$fighter = new Archer();
			else if ($type === "assassin")
				$fighter = new Assassin();

			print("(Factory fabricates a fighter of type " . $type . ")" . PHP_EOL);
			return $fighter; 
		}
		else {
			print("(Factory hasn't absorbed any fighter of type " . $type . ")" . PHP_EOL);
		}

		return NULL;
	}
}

?>
