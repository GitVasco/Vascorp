<?php

require_once "conexion.php";

class ModeloCuentas{

	/*=============================================
	CREAR UNIDAD MEDIDA
	=============================================*/

	static public function mdlIngresarCuenta($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo_doc,num_cta,cliente,vendedor,fecha,fecha_ven,fecha_cep,tip_mon,monto,tip_cambio,estado,notas,cod_pago,doc_origen,renovacion,protesta,usuario,saldo,ult_pago,estado_doc,banco,num_unico,fecha_envio,fecha_abono) VALUES (:tipo_doc,:num_cta,:cliente,:vendedor,:fecha,:fecha_ven,:fecha_cep,:tip_mon,:monto,:tip_cambio,:estado,:notas,:cod_pago,:doc_origen,:renovacion,:protesta,:usuario,:saldo,:ult_pago,:estado_doc,:banco,:num_unico,:fecha_envio,:fecha_abono)");

		$stmt->bindParam(":tipo_doc", $datos["tipo_doc"], PDO::PARAM_STR);
		$stmt->bindParam(":num_cta", $datos["num_cta"], PDO::PARAM_STR);
		$stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ven", $datos["fecha_ven"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_cep", $datos["fecha_cep"], PDO::PARAM_STR);
		$stmt->bindParam(":tip_mon", $datos["tip_mon"], PDO::PARAM_STR);
		$stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_STR);
		$stmt->bindParam(":tip_cambio", $datos["tip_cambio"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":notas", $datos["notas"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_pago", $datos["cod_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":doc_origen", $datos["doc_origen"], PDO::PARAM_STR);
		$stmt->bindParam(":renovacion", $datos["renovacion"], PDO::PARAM_STR);
		$stmt->bindParam(":protesta", $datos["protesta"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":saldo", $datos["saldo"], PDO::PARAM_STR);
		$stmt->bindParam(":ult_pago", $datos["ult_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_doc", $datos["estado_doc"], PDO::PARAM_STR);
		$stmt->bindParam(":banco", $datos["banco"], PDO::PARAM_STR);
		$stmt->bindParam(":num_unico", $datos["num_unico"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_envio", $datos["fecha_envio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_abono", $datos["fecha_abono"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    

	/*=============================================
	MOSTRAR CUENTAS
	=============================================*/

	static public function mdlMostrarCuentas($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and tipo_doc IN ('01','03','07','08','09','85')");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE tipo_doc IN ('01','03','07','08','09','85')");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}
	
	static public function mdlMostrarPagos($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY codigo");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}
	
	static public function mdlMostrarCancelaciones($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and tipo_doc NOT IN ('01','03','07','08','09','85')");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE tipo_doc NOT IN ('01','03','07','08','09','85')");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }
	
	
	static public function mdlMostrarCancelacion($tabla,$item,$valor){


		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and saldo IS NULL");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

    }
	/*=============================================
	EDITAR TIPO DE PAGO
	=============================================*/

	static public function mdlEditarCuenta($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tipo_doc=:tipo_doc,num_cta=:num_cta,cliente=:cliente,vendedor=:vendedor,fecha=:fecha,fecha_ven=:fecha_ven,fecha_cep=:fecha_cep,tip_mon=:tip_mon,monto=:monto,tip_cambio=:tip_cambio,estado=:estado,notas=:notas,cod_pago=:cod_pago,doc_origen=:doc_origen,renovacion=:renovacion,protesta=:protesta,usuario=:usuario,saldo=:saldo,ult_pago=:ult_pago,estado_doc=:estado_doc,banco=:banco,num_unico=:num_unico,fecha_envio=:fecha_envio,fecha_abono=:fecha_abono WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":tipo_doc", $datos["tipo_doc"], PDO::PARAM_STR);
		$stmt->bindParam(":num_cta", $datos["num_cta"], PDO::PARAM_STR);
		$stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ven", $datos["fecha_ven"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_cep", $datos["fecha_cep"], PDO::PARAM_STR);
		$stmt->bindParam(":tip_mon", $datos["tip_mon"], PDO::PARAM_STR);
		$stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_STR);
		$stmt->bindParam(":tip_cambio", $datos["tip_cambio"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":notas", $datos["notas"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_pago", $datos["cod_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":doc_origen", $datos["doc_origen"], PDO::PARAM_STR);
		$stmt->bindParam(":renovacion", $datos["renovacion"], PDO::PARAM_STR);
		$stmt->bindParam(":protesta", $datos["protesta"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":saldo", $datos["saldo"], PDO::PARAM_STR);
		$stmt->bindParam(":ult_pago", $datos["ult_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_doc", $datos["estado_doc"], PDO::PARAM_STR);
		$stmt->bindParam(":banco", $datos["banco"], PDO::PARAM_STR);
		$stmt->bindParam(":num_unico", $datos["num_unico"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_envio", $datos["fecha_envio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_abono", $datos["fecha_abono"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
	
	
	/*=============================================
	ELIMINAR TIPO DE PAGO
	=============================================*/

	static public function mdlEliminarCuenta($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}    

	/* 
	* Método para actualizar un dato CON EL articulo
	*/
	static public function mdlActualizarUnDato($tabla, $item1, $valor1, $valor2){

		$sql = "UPDATE $tabla SET $item1=:$item1 WHERE id=:id";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":id", $valor2, PDO::PARAM_INT);

		$stmt->execute();

		$stmt = null;
	}
	/*=============================================
	ELIMINAR TIPO DE PAGO
	=============================================*/

	static public function mdlMostrarCuentasPendientes($tabla,$saldo){

		if($saldo != "null" ){
			$stmt = Conexion::conectar()->prepare("SELECT 
													* 
												FROM
													$tabla 
												WHERE saldo > 0 
													AND tipo_doc IN ('01', '03', '07', '08', '09', '85') 
												ORDER BY saldo BETWEEN ($saldo - 10) 
													AND ($saldo + 10) DESC,
													saldo ASC ");
	
			$stmt -> execute();
	
			return $stmt -> fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT 
														* 
													FROM
														$tabla 
													WHERE saldo > 0 
														AND tipo_doc IN ('01', '03', '07', '08', '09', '85') 
													ORDER BY saldo ASC ");

			$stmt -> execute();
	
			return $stmt -> fetchAll();
		}
		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
	MOSTRAR CUENTAS
	=============================================*/

	static public function mdlMostrarTipoCuentas($tabla,$item,$valor){

		if($valor != "null"){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND tipo_doc IN ('01','03','07','08','09','85')");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE tipo_doc IN ('01','03','07','08','09','85')");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
	
			$stmt -> execute();
	
			return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasCuentas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE tipo_doc IN ('01','03','07','08','09','85')  ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%' AND tipo_doc IN ('01','03','07','08','09','85')");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND tipo_doc IN ('01','03','07','08','09','85')");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' AND tipo_doc IN ('01','03','07','08','09','85')");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasCuentasPendientes($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE tipo_doc IN ('01','03','07','08','09','85') AND estado='PENDIENTE' ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%' AND tipo_doc IN ('01','03','07','08','09','85') AND estado='PENDIENTE' ");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND tipo_doc IN ('01','03','07','08','09','85') AND estado='PENDIENTE' ");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' AND tipo_doc IN ('01','03','07','08','09','85') AND estado='PENDIENTE' ");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasCuentasAprobadas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE tipo_doc IN ('01','03','07','08','09','85') AND estado='CANCELADO'  ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%' AND tipo_doc IN ('01','03','07','08','09','85') AND estado='CANCELADO' ");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND tipo_doc IN ('01','03','07','08','09','85') AND estado='CANCELADO'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' AND tipo_doc IN ('01','03','07','08','09','85') AND estado='CANCELADO'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}
}