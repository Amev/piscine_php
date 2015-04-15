<?php

abstract class House {

	abstract public function getHouseName();
	abstract public function getHouseMotto();
	abstract public function getHouseSeat();

	public function introduce() {

		$name = static::getHouseName();
		$seat = static::getHouseSeat();
		$motto = static::getHouseMotto();
		print("House " . $name . " of " . $seat . ' : "' . $motto . '"' . PHP_EOL);
		return;
	}
}

?>
