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

	static public function mdlMostarArticulosOrdCorte(){

		$stmt = Conexion::conectar()->prepare("CALL sp_1055_articulos_ordcorte()");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
	}
	
	/* 
	* Método para actualizar el total del corte por articulo
	*/
	static public function mdlActualizarAlmCorte($valor, $valor1){

		$stmt = Conexion::conectar()->prepare("CALL sp_1056_update_articulos_almcorte_p(:valor, :valor1)");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt->bindParam(":valor1", $valor1, PDO::PARAM_STR);

		$stmt->execute();

		$stmt = null;

	}

	/* 
	* Método para actualizar los saldos de detalle de ordenes de corte
	*/
	static public function mdlActualizarSaldoOrdCorte($valor, $valor1, $valor2){

		$stmt = Conexion::conectar()->prepare("CALL sp_1057_update_ordencorte_saldo_p(:valor, :valor1, :valor2)");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt->bindParam(":valor1", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":valor2", $valor2, PDO::PARAM_STR);

		$stmt->execute();

		$stmt = null;

	}

	/* 
	* Método para actualizar los saldos de ordenes de corte
	*/
	static public function mdlActualizarSaldoOrdCorteGral(){

		$stmt = Conexion::conectar()->prepare("CALL sp_1058_update_ordencorte_saldo()");

		$stmt->execute();

		$stmt = null;

	}





}