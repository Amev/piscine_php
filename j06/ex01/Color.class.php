<?php
# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Color.class.php                                    :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: vame <vame@student.42.fr>                  +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2015/04/14 10:54:27 by vame              #+#    #+#              #
#    Updated: 2015/04/14 10:54:27 by vame             ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

class Color {

	public $red = 0;
	public $blue = 0;
	public $green = 0;
	public static $verbose = FALSE;

	public function __construct(array $kwargs) {

		if (array_key_exists('rgb', $kwargs)) {

			$kwargs['rgb'] = intval($kwargs['rgb']);
			$this->blue = $kwargs['rgb'] & 0xFF;
			$this->green = ($kwargs['rgb'] & 0xFF00) >> 8;
			$this->red = ($kwargs['rgb'] & 0xFF0000) >> 16;
			//$this->red = ($this->red > 255) ? 255 : (($this->red < 0) ? 0 : $this->red);
			//$this->blue = ($this->blue > 255) ? 255 : (($this->blue < 0) ? 0 : $this->blue);
			//$this->green = ($this->green > 255) ? 255 : (($this->green < 0) ? 0 : $this->green);
		}
		else {

			$this->red = intval($kwargs['red'], 10);
			$this->blue = intval($kwargs['blue'], 10);
			$this->green = intval($kwargs['green'], 10);
		}

		if (self::$verbose === TRUE) {
			print($this . ' constructed.' . PHP_EOL);
		}
		return;
	}

	public function __destruct() {

		if (self::$verbose === TRUE) {
			print($this . ' destructed.' . PHP_EOL);
		}
		return;
	}

	public function __tostring() {

		$r = sprintf("%3d", $this->red);
		$b = sprintf("%3d", $this->blue);
		$g = sprintf("%3d", $this->green);
		return 'Color( red: ' . $r . ', green: ' . $g . ', blue: ' . $b . ' )';
	}

	public static function doc() {
		return file_get_contents("Color.doc.txt");
	}

	public function add(Color $b) {

		$c = clone $this;
		$c->red = $this->red + $b->red;
		$c->blue = $this->blue + $b->blue;
		$c->green = $this->green + $b->green;
		//$c->red = $c->red > 255 ? 255 : $c->red;
		//$c->blue = $c->blue > 255 ? 255 : $c->blue;
		//$c->green = $c->green > 255 ? 255 : $c->green;

		if (self::$verbose === TRUE) {
			print($c . ' constructed.' . PHP_EOL);
		}
		return $c;
	}

	public function sub(Color $b) {

		$c = clone $this;
		$c->red = $this->red - $b->red;
		$c->blue = $this->blue - $b->blue;
		$c->green = $this->green - $b->green;
		//$c->red = $c->red < 0 ? 0 : $c->red;
		//$c->blue = $c->blue < 0 ? 0 : $c->blue;
		//$c->green = $c->green < 0 ? 0 : $c->green;

		if (self::$verbose === TRUE) {
			print($c . ' constructed.' . PHP_EOL);
		}
		return $c;
	}

	public function mult($b) {

		$c = clone $this;
		$c->red = intval($this->red * $b);
		$c->blue = intval($this->blue * $b);
		$c->green = intval($this->green * $b);
		//$c->red = ($c->red > 255) ? 255 : (($c->red < 0) ? 0 : $c->red);
		//$c->blue = ($c->blue > 255) ? 255 : (($c->blue < 0) ? 0 : $c->blue);
		//$c->green = ($c->green > 255) ? 255 : (($c->green < 0) ? 0 : $c->green);

		if (self::$verbose === TRUE) {
			print($c . ' constructed.' . PHP_EOL);
		}
		return $c;
	}
}

?>
