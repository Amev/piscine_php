<?php
# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Vector.class.php                                   :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: vame <vame@student.42.fr>                  +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2015/04/14 17:00:26 by vame              #+#    #+#              #
#    Updated: 2015/04/14 17:00:26 by vame             ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

require_once 'Vertex.class.php';

class Vector {

	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 0;
	public static $verbose = FALSE;

	public function getX() { return $this->_x; }
	public function getY() { return $this->_y; }
	public function getZ() { return $this->_z; }
	public function getW() { return $this->_w; }

	public function __construct(array $kwargs) {

		if (array_key_exists("orig", $kwargs)) {

			if (!is_a($kwargs["orig"], "Vertex")) {

				print('Error type, $orig is not a Vertex' . PHP_EOL);
				exit(-1);
			}
		}
		else {
			$kwargs["orig"] = new Vertex(array("x" => 0, "y" => 0, "z" => 0));
		}

		if (!is_a($kwargs["dest"], "Vertex")) {

			print('Error type, $orig is not a Vertex' . PHP_EOL);
			exit(-1);
		}

		$this->_x = $kwargs["dest"]->getX() - $kwargs["orig"]->getX();
		$this->_y = $kwargs["dest"]->getY() - $kwargs["orig"]->getY();
		$this->_z = $kwargs["dest"]->getZ() - $kwargs["orig"]->getZ();

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

		$x = sprintf("%.2f", $this->_x);
		$y = sprintf("%.2f", $this->_y);
		$z = sprintf("%.2f", $this->_z);
		$w = sprintf("%.2f", $this->_w);
		return 'Vector( x:' . $x . ', y:' . $y . ', z:' . $z . ', w:' . $w . ' )';
	}

	public static function doc() {
		return file_get_contents("Vector.doc.txt");
	}

	public function magnitude() {

		$x = $this->_x * $this->_x;
		$y = $this->_y * $this->_y;
		$z = $this->_z * $this->_z;

		return sqrt($x + $y + $z);
	}

	public function normalize() {

		$len = $this->magnitude();
		$x = $this->_x / $len;
		$y = $this->_y / $len;
		$z = $this->_z / $len;

		$vertex = new Vertex(array("x" => $x, "y" => $y, "z" => $z));
		$vector = new Vector(array("dest" => $vertex));
		$vertex->__destruct();
		return $vector;
	}

	public function add(Vector $rhs) {

		$x = $this->_x + $rhs->getX();
		$y = $this->_y + $rhs->getY();
		$z = $this->_z + $rhs->getZ();

		$vertex = new Vertex(array("x" => $x, "y" => $y, "z" => $z));
		$vector = new Vector(array("dest" => $vertex));
		$vertex->__destruct();
		return $vector;
	}

	public function sub(Vector $rhs) {

		$x = -$rhs->_x + $this->getX();
		$y = -$rhs->_y + $this->getY();
		$z = -$rhs->_z + $this->getZ();

		$vertex = new Vertex(array("x" => $x, "y" => $y, "z" => $z));
		$vector = new Vector(array("dest" => $vertex));
		$vertex->__destruct();
		return $vector;
	}

	public function opposite() {

		$x = -$this->_x;
		$y = -$this->_y;
		$z = -$this->_z;

		$vertex = new Vertex(array("x" => $x, "y" => $y, "z" => $z));
		$vector = new Vector(array("dest" => $vertex));
		$vertex->__destruct();
		return $vector;
	}

	public function scalarProduct($k) {

		$x = $k * $this->_x;
		$y = $k * $this->_y;
		$z = $k * $this->_z;

		$vertex = new Vertex(array("x" => $x, "y" => $y, "z" => $z));
		$vector = new Vector(array("dest" => $vertex));
		$vertex->__destruct();
		return $vector;
	}

	public function dotProduct(Vector $rhs) {

		$x = $this->_x * $rhs->getX();
		$y = $this->_y * $rhs->getY();
		$z = $this->_z * $rhs->getZ();

		return $x + $y + $z;
	}

	public function cos(Vector $rhs) {

		$x = $this->_x / $this->magnitude() * $rhs->getX() / $rhs->magnitude();
		$y = $this->_y / $this->magnitude() * $rhs->getY() / $rhs->magnitude();
		$z = $this->_z / $this->magnitude() * $rhs->getZ() / $rhs->magnitude();

		return $x + $y + $z;
	}

	public function crossProduct(Vector $rhs) {

		$x = $this->_y * $rhs->getZ() - $this->_z * $rhs->getY();
		$y = $this->_z * $rhs->getX() - $this->_x * $rhs->getZ();
		$z = $this->_x * $rhs->getY() - $this->_y * $rhs->getX();

		$vertex = new Vertex(array("x" => $x, "y" => $y, "z" => $z));
		$vector = new Vector(array("dest" => $vertex));
		$vertex->__destruct();
		return $vector;
	}
}

?>
