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

require_once 'Vector.class.php';

class Matrix {

	const RX = 1;
	const RY = 2;
	const RZ = 3;
	const SCALE = 4;
	const IDENTITY = 5;
	const PROJECTION = 6;
	const TRANSLATION = 7;
	private $_matrix;
	public static $verbose = FALSE;

	public function getMatrix() { return $this->_matrix; }

	public function __construct(array $kwargs) {

		$type = $kwargs["preset"];

		if ($type == self::SCALE) {

			$str = "SCALE preset";
			$scale = $kwargs["scale"];
			$this->_matrix = $this->_scaleMatrix($scale);
		}
		else if ($type == self::RX || $type == self::RY || $type == self::RZ) {

			$str = $type == self::RX ? "Ox ROTATION preset" : "Oy ROTATION preset";
			$str = $type == self::RZ ? "Oz ROTATION preset" : $str;
			$angle = $kwargs["angle"];
			$this->_matrix = $this->_rotMatrix($angle, $type);
		}
		else if ($type == self::IDENTITY) {

			$str = "IDENTITY";
			$this->_matrix = $this->_idMatrix();
		}
		else if ($type == self::TRANSLATION) {

			$str = "TRANSLATION preset";
			$vtc = $kwargs["vtc"];
			$this->_matrix = $this->_transMatrix($vtc);
		}
		else if ($type == self::PROJECTION) {

			$str = "PROJECTION preset";
			$fov = $kwargs["fov"];
			$far = $kwargs["far"];
			$near = $kwargs["near"];
			$ratio = $kwargs["ratio"];
			$this->_matrix = $this->_projMatrix($fov, $ratio, $near, $far);
		}
		else {

			print("Error preset of matrix, plz look documentation" . PHP_EOL);
			exit(-1);
		}

		if (self::$verbose === TRUE) {
			print("Matrix " . $str . " instance constructed" . PHP_EOL);
		}
		return;
	}

	private function _newMatrix() {

		$x = 0;
		$mat = array(array());

		while ($x++ < 4) {

			$y = 0;
			while ($y < 4) {

				$mat[$x - 1][$y++] = 0.0;
			}
		}

		return $mat;
	}

	private function _idMatrix() {

		$mat = $this->_newMatrix();
		$mat[0][0] = 1.0;
		$mat[1][1] = 1.0;
		$mat[2][2] = 1.0;
		$mat[3][3] = 1.0;

		return $mat;
	}

	private function _scaleMatrix($scale) {

		if (!is_numeric($scale)) {

			print('Error $vtc is not a float' . PHP_EOL);
			exit(-1);
		}

		$mat = $this->_newMatrix();
		$mat[0][0] = $scale;
		$mat[1][1] = $scale;
		$mat[2][2] = $scale;
		$mat[3][3] = 1.0;

		return $mat;
	}

	private function _transMatrix($vtc) {

		if (!is_a($vtc, "Vector")) {

			print('Error $vtc is not a Vector' . PHP_EOL);
			exit(-1);
		}

		$mat = $this->_idMatrix();
		$mat[0][3] = $vtc->getX();
		$mat[1][3] = $vtc->getY();
		$mat[2][3] = $vtc->getZ();

		return $mat;
	}

	private function _rotMatrix($angle, $rot) {

		if (!is_numeric($angle)) {

			print('Error $vtc is not a float' . PHP_EOL);
			exit(-1);
		}

		$mat = $this->_idMatrix();

		if ($rot === self::RX) {

			$mat[1][1] = cos($angle);
			$mat[1][2] = -sin($angle);
			$mat[2][1] = sin($angle);
			$mat[2][2] = cos($angle);
		}
		else if ($rot === self::RY) {

			$mat[0][0] = cos($angle);
			$mat[0][2] = sin($angle);
			$mat[2][0] = -sin($angle);
			$mat[2][2] = cos($angle);
		}
		else if ($rot === self::RZ) {

			$mat[0][0] = cos($angle);
			$mat[0][1] = -sin($angle);
			$mat[1][0] = sin($angle);
			$mat[1][1] = cos($angle);
		}

		return $mat;
	}

	private function _projMatrix($fov, $ratio, $near, $far) {

		if (!is_numeric($far) || !is_numeric($ratio) || !is_numeric($near) || !is_numeric($fov)) {

			print('Error $far or $ratio or $near or $fov are not floats' . PHP_EOL);
			exit(-1);
		}

		$mat = $this->_newMatrix();
		$s = (1 / tan(deg2rad($fov * 0.5))) / $ratio;
		$ss = 1 / tan(deg2rad($fov * 0.5));
		$zz = -($far + $near) / ($far - $near);
		$zw = -2 * ($far * $near) / ($far - $near);
		$mat[0][0] = $s;
		$mat[1][1] = $ss;
		$mat[2][2] = $zz;
		$mat[2][3] = $zw;
		$mat[3][2] = -1;

		return $mat;
	}

	public function mult(Matrix $rhs) {

		$y = 0;
		$ext = $rhs->getMatrix();
		$mat = $this->_newMatrix();
		while ($y < 4) {

			$x = 0;
			while ($x < 4) {

				$z = 0;
				while ($z < 4) {

					$mat[$y][$x] += $this->_matrix[$y][$z] * $ext[$z][$x];
					$z++;
				}
				$x++;
			}
			$y++;
		}

		$tmp = $this->_matrix;
		$this->_matrix = $mat;
		$new = clone $this;
		$this->_matrix = $tmp;
		return $new;
	}

	public function transformVertex(Vertex $vtx) {

		$vx = $vtx->getX();
		$vy = $vtx->getY();
		$vz = $vtx->getZ();
		$vw = $vtx->getW();
		$mat = $this->_matrix;

		$x = $mat[0][0] * $vx + $mat[0][1] * $vy + $mat[0][2] * $vz + $mat[0][3] * $vw;
		$y = $mat[1][0] * $vx + $mat[1][1] * $vy + $mat[1][2] * $vz + $mat[1][3] * $vw;
		$z = $mat[2][0] * $vx + $mat[2][1] * $vy + $mat[2][2] * $vz + $mat[2][3] * $vw;
		$w = $mat[3][0] * $vx + $mat[3][1] * $vy + $mat[3][2] * $vz + $mat[3][3] * $vw;

		$vertex = new Vertex(array("x" => $x, "y" => $y, "z" => $z, "w" => $w));
		return $vertex;
	}

	public function __destruct() {

		if (self::$verbose === TRUE) {
			print('Matrix instance destructed' . PHP_EOL);
		}
		return;
	}

	private function _p($value) {

		return sprintf("%.2f", $value);
	}

	public function __tostring() {

		$str = "M | vtcX | vtcY | vtcZ | vtxO" . PHP_EOL . "-----------------------------" . PHP_EOL . "x | ";
		$str = $str . $this->_p($this->_matrix[0][0]) . " | " . $this->_p($this->_matrix[0][1]);
		$str = $str . " | " . $this->_p($this->_matrix[0][2]) . " | " . $this->_p($this->_matrix[0][3]);
		$str = $str . PHP_EOL . "y | " . $this->_p($this->_matrix[1][0]) . " | ";
		$str = $str . $this->_p($this->_matrix[1][1]) . " | " . $this->_p($this->_matrix[1][2]);
		$str = $str . " | " . $this->_p($this->_matrix[1][3]) . PHP_EOL . "z | ";
		$str = $str . $this->_p($this->_matrix[2][0]) . " | " . $this->_p($this->_matrix[2][1]);
		$str = $str . " | " . $this->_p($this->_matrix[2][2]) . " | " . $this->_p($this->_matrix[2][3]);
		$str = $str . PHP_EOL . "w | " . $this->_p($this->_matrix[3][0]) . " | ";
		$str = $str . $this->_p($this->_matrix[3][1]) . " | " . $this->_p($this->_matrix[3][2]);
		$str = $str . " | " . $this->_p($this->_matrix[3][3] . PHP_EOL);
		return $str;
	}

	public static function doc() {
		return file_get_contents("Matrix.doc.txt");
	}
}

?>
