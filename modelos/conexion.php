<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=192.168.1.4;dbname=new_vasco",
			            "jesus",
			            "admin123");

		$link->exec("set names utf8");

		return $link;

	}

}