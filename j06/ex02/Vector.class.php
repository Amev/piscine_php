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
		return file_get_contents("Vertex.doc.txt");
	}

	public float magnitude() {
		return sqrt(pow($this->_x, 2) + pow($this->_y, 2) + pow($this->_z, 2)); 
	}

	public Vector normalize() {
	
		$len = $this->magnitude();
		$x = $this->_x / $len;
		$y = $this->_y / $len;
		$z = $this->_z / $len;

		$vertex = new Vertex(array("x" => $x, "y" => $y, "z" => $z));
		$vector = new Vector(array("dest" => $vertex));
		$vertex->__destruct();
		return $vector;
	}

	public Vector add(Vector $rhs) {
		
		$x = $this->_x + $rhs->getX();
		$y = $this->_x + $rhs->getY();
		$z = $this->_x + $rhs->getZ();

		$vertex = new Vertex(array("x" => $x, "y" => $y, "z" => $z));
		$vector = new Vector(array("dest" => $vertex));
		$vertex->__destruct();
		return $vector;
	}

	public Vector sub(Vector $rhs) {
		
		$x = $rhs->_x - $this->getX();
		$y = $rhs->_x - $this->getY();
		$z = $rhs->_x - $this->getZ();

		$vertex = new Vertex(array("x" => $x, "y" => $y, "z" => $z));
		$vector = new Vector(array("dest" => $vertex));
		$vertex->__destruct();
		return $vector;
	}
	
	public Vector opposite() {
	
		$x = -$this->_x;
		$y = -$this->_y;
		$z = -$this->_z;

		$vertex = new Vertex(array("x" => $x, "y" => $y, "z" => $z));
		$vector = new Vector(array("dest" => $vertex));
		$vertex->__destruct();
		return $vector;
	}

	public Vector scalarProduct($k) {
	
		$x = $k * $this->_x;
		$y = $k * $this->_y;
		$z = $k * $this->_z;

		$vertex = new Vertex(array("x" => $x, "y" => $y, "z" => $z));
		$vector = new Vector(array("dest" => $vertex));
		$vertex->__destruct();
		return $vector;
	}

	public float dotProduct(Vector $rhs) {
	
		$x = $this->_x * $rhs->getX();
		$y = $this->_y * $rhs->getY();
		$z = $this->_z * $rhs->getZ();

		return $x + $y + $z;
	}
}

?>
