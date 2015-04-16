<?php
# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Ships.Class.php                                    :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: vame <vame@student.42.fr>                  +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2015/04/16 13:11:24 by vame              #+#    #+#              #
#    Updated: 2015/04/16 13:11:24 by vame             ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

Interface Ships {

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
	
	public int function getXPos();
	public int function getYPos();
	public int function getHp();
	public int function getPp();
	public int function getSpeed();
	public int function getMan();
	public int function getShield();
	public int function getXSize();
	public int function getYSize();
	public bool function getHSens();
	public string function getShipName();
	public string function getSpriteName();
	public array function getWeapons();

}
