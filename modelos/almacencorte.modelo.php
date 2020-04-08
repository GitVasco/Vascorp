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

	/*
	* Guardar cabecera de Almacen DE CORTE
	*/
	static public function mdlGuardarAlmacenCorte($datos){

		$sql="CALL sp_1059_insert_almcorte_p(:codigo, :usuario, :total, :estado)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_INT);
		$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_INT);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_INT);
		$stmt->bindParam(":estado",$datos["estado"],PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}

	/*
	* Guardar detalle de almacen de corte
	*/
	static public function mdlGuardarDetallesAlmacenCorte($datos){

		$sql="CALL sp_1060_insert_almcorte_detalle_p(:almcorte, :ordcorte, :detordcorte, :art, :cant)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":almcorte",$datos["almacencorte"],PDO::PARAM_INT);
		$stmt->bindParam(":ordcorte",$datos["ordcorte"],PDO::PARAM_INT);
		$stmt->bindParam(":detordcorte",$datos["idocd"],PDO::PARAM_INT);
		$stmt->bindParam(":art",$datos["articulo"],PDO::PARAM_INT);
		$stmt->bindParam(":cant",$datos["cantidad"],PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;

	}

	/*
	* Método para DESCONTAR el total del corte por articulo -ORD CORTE
	*/
	static public function mdlActualizarOrdCorte($valor, $valor1){

		$stmt = Conexion::conectar()->prepare("CALL sp_1061_update_articulos_ordcorte_p(:valor, :valor1)");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt->bindParam(":valor1", $valor1, PDO::PARAM_STR);

		$stmt->execute();

		$stmt = null;

	}

	/*
	* Método para mostrar los datos de almacen de corte
	*/
	static public function mdlMostrarAlmacenCorte($valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("CALL sp_1062_consulta_almacencorte()");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*
	* Método para actualizar lel estado de ordenes de corte a parcial
	*/
	static public function mdlActualizarOrdCorteEstadoParcial(){

		$stmt = Conexion::conectar()->prepare("CALL sp_1063_update_ordencorte_parcial()");

		$stmt->execute();

		$stmt = null;

	}

	/*
	* Método para actualizar lel estado de ordenes de corte a cerrado
	*/
	static public function mdlActualizarOrdCorteEstadoCerrado(){

		$stmt = Conexion::conectar()->prepare("CALL sp_1064_update_ordencorte_cerrado()");

		$stmt->execute();

		$stmt = null;

	}

	/*
	* Método para ingresar la cantidad de cortes por operacion
	*/
	static public function mdlIngresarCantCorte($valor, $valor1){

		$stmt = Conexion::conectar()->prepare("UPDATE encortejf
													SET
														cantidad = cantidad + :valor1,
														total_precio = (precio_doc / 12) * cantidad,
														total_tiempo = (tiempo_stand / 60) * cantidad
													WHERE
														articulo = :valor");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt->bindParam(":valor1", $valor1, PDO::PARAM_STR);

		$stmt->execute();

		$stmt = null;

	}


}