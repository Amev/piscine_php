<?php
# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    D6.Class.php                                       :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: vame <vame@student.42.fr>                  +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2015/04/16 13:11:24 by vame              #+#    #+#              #
#    Updated: 2015/04/16 13:11:24 by vame             ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

class D6 {

	private int $_result;
	
	public int function getResult() { return $this->_result; }

	public function __construct() {

		$this->_result = rand(1, 6);
		return;
	}

	public function __destruct() {

		return;
	}

	public static function doc() {

		return file_get_contents("../docs/D6.doc.txt");
	}
}
