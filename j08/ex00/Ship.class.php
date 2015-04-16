<?php
# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Ship.Class.php                                     :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: vame <vame@student.42.fr>                  +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2015/04/16 13:11:24 by vame              #+#    #+#              #
#    Updated: 2015/04/16 13:11:24 by vame             ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

abstract class Ship {

	private int $_xPos;
	private int $_yPos;
	private int $_hp;
	private int $_pp;
	private int $_speed;
	private int $_man;
	private int $_shield;
	private int $_xSize;
	private int $_ySize;
	private bool $_hSens;
	private string $_shipName;
	private string $_spriteName;
	private array $_weapons;
	
	public int function getXPos() { return $this->_xPos; }
	public int function getYPos() { return $this->_yPos; }
	public int function getHp() { return $this->_hp; }
	public int function getPp() { return $this->_pp }
	public int function getSpeed() { return $this->_speed; }
	public int function getMan() { return $this->_man; }
	public int function getShield() { return $this->_shield; }
	public int function getXSize() { return $this->_xSize; }
	public int function getYSize() { return $this->_ySize; }
	public bool function getHSens() { return $this->_hSens; }
	public string function getShipName() { return $this->_shipName; }
	public string function getSpriteName() { return $this->_spriteName; }
	public array function getWeapons() { return $this->_weapons; }

	public function __construct(int $player, int $map_div, int $index, string $name) {

		if ($player === 0) {
			
			$this->xPos = 4;
			$this->yPos = $index * 3 + 2;
		}
		else if ($player
	}
}
