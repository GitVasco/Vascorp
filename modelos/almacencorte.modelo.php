<?php
require_once "conexion.php";

class ModeloAlmacenCorte{

  	/* 
	* Método para sacar el ultimo codigo del almacen de corte
	*/	
	static public function mdlUltimoCodigoAC(){

        $stmt = Conexion::conectar()->prepare("CALL sp_1054_almcorte_ultcod()");

		$stmt->execute();

		return $stmt->fetch();

		$stmt=null;


	}

}