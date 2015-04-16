<?php
# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Map.Class.php                                      :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: vame <vame@student.42.fr>                  +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2015/04/16 13:11:24 by vame              #+#    #+#              #
#    Updated: 2015/04/16 13:11:24 by vame             ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

class Map{

	private int $_width;
	private int $_height;
	private array $_ships;

	public array function getShips() { return $this->_ships; }
	public array function getWidth() { return $this->_width; }
	public array function getHeight() { return $this->_height; }

	public function __construct() {

		$this->_width = 150;
		$this->_height = 100;
		$this->_ships = $this->create_ships();

		return;
	}

	private array function create_ships() {

		$player = 0;
		$map_div = 2;
		$ships = array();
		while ($player < 2) {

			array_push($ships, new Ship($player, $map_div, 1));
		}

		return $ships;
	}

	public function __destruct() {

		return;
	}

	public static function doc() {

		return file_get_contents("../docs/Map.doc.txt");
	}
}

?>
