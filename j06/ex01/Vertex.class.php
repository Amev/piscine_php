<?php
# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Vertex.class.php                                   :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: vame <vame@student.42.fr>                  +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2015/04/14 13:07:40 by vame              #+#    #+#              #
#    Updated: 2015/04/14 13:07:40 by vame             ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

require_once 'Color.class.php';

class Vertex {

	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_color;
	private $_w = 1.0;
	public static $verbose = FALSE;

	public function setX($x) {

		$this->_x = floatval($x);
		return;
	}

	public function setY($y) {

		$this->_y = floatval($y);
		return;
	}

	public function setZ($z) {

		$this->_z = floatval($z);
		return;
	}

	public function setW($w) {

		$this->_w = floatval($w);
		return;
	}

	public function setColor($color) {

		if ($color && is_a($color, "Color")) {
			$this->_color = $color;
		}
		return;
	}

	public function getX() { return $this->_x; }

	public function getY() { return $this->_y; }

	public function getZ() { return $this->_z; }

	public function getW() { return $this->_w; }

	public function getColor() { return $this->_color; }

	public function __construct(array $kwargs) {

		if (array_key_exists('w', $kwargs)) {
			$this->setW($kwargs['w']);
		}

		if (array_key_exists('color', $kwargs) && is_a($kwargs['color'], "Color")) {
			$this->setColor($kwargs['color']);
		}
		else {
			$this->_color = new Color(array("rgb" => 0xFFFFFF));
		}

		$this->setX($kwargs['x']);
		$this->setY($kwargs['y']);
		$this->setZ($kwargs['z']);

		if (self::$verbose === TRUE) {
			print($this . ' constructed' . PHP_EOL);
		}
		return;
	}

	public function __destruct() {

		if (self::$verbose === TRUE) {
			print($this . ' destructed' . PHP_EOL);
		}
		return;
	}

	public function __tostring() {

		$c = self::$verbose === TRUE ? ', ' . $this->_color->__tostring() : "";
		$x = ' x: ' . sprintf("%.2f", $this->_x);
		$y = ' y: ' . sprintf("%.2f", $this->_y);
		$z = ' z:' . sprintf("%.2f", $this->_z);
		$w = ' w:' . sprintf("%.2f", $this->_w);
		return 'Vertex(' . $x . ',' . $y . ',' . $z . ',' . $w . $c . ' )';
	}

	public static function doc() {
		return file_get_contents("Vertex.doc.txt");
	}
}

?>
