<?php
require_once "conexion.php";

class ModeloAlmacenCorte{

  	/* 
	* Método para sacar el ultimo codigo del almacen de corte
	*/	
	static public function mdlUltimoCodigoOC(){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;


	}

}