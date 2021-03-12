<?php

require_once "conexion.php";

class ModeloCuentas{

	/*=============================================
	CREAR CUENTA
	=============================================*/

	static public function mdlIngresarCuenta($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo_doc,num_cta,cliente,vendedor,fecha,fecha_ven,fecha_cep,tip_mon,monto,tip_cambio,estado,notas,cod_pago,doc_origen,renovacion,protesta,usuario,saldo,ult_pago,estado_doc,banco,num_unico,fecha_envio,fecha_abono,tip_mov) VALUES (:tipo_doc,:num_cta,:cliente,:vendedor,:fecha,:fecha_ven,:fecha_cep,:tip_mon,:monto,:tip_cambio,:estado,:notas,:cod_pago,:doc_origen,:renovacion,:protesta,:usuario,:saldo,:ult_pago,:estado_doc,:banco,:num_unico,:fecha_envio,:fecha_abono,:tip_mov)");

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
		$stmt->bindParam(":tip_mov", $datos["tip_mov"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    

	static public function mdlIngresarCuentaBckp($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO cuenta_cte_bkpjf 
		(SELECT 
		  *,
		  :usuario_bkp,
		  :fecha_bkp 
		FROM
		  cuenta_ctejf
		  WHERE num_cta = :num_cta) ;");

		$stmt->bindParam(":usuario_bkp", $datos["usuario_bkp"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_bkp", $datos["fecha_bkp"], PDO::PARAM_STR);
		$stmt->bindParam(":num_cta", $datos["num_cta"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    

	static public function mdlIngresarCuentaBckp2($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO cuenta_cte_bkpjf 
		(SELECT 
		  *,
		  :usuario_bkp,
		  :fecha_bkp 
		FROM
		  cuenta_ctejf
		  WHERE id = :id) ;");

		$stmt->bindParam(":usuario_bkp", $datos["usuario_bkp"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_bkp", $datos["fecha_bkp"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);


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

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE c.tip_mov ='+' AND c.$item = :$item ");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE c.tip_mov ='+'");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR CUENTAS
	=============================================*/

	static public function mdlMostrarCuentasUnicos($tabla,$item,$valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT c.*,REPLACE(DATE_FORMAT(c.fecha_ven,'%d-%m-%Y'),'-','') AS fechaVen,REPLACE(c.num_cta,'-','') AS cuenta,cli.nombre,cli.ape_paterno,cli.ape_materno,cli.nombres,cli.documento FROM $tabla c 
			LEFT JOIN clientesjf cli ON c.cliente=cli.codigo
			WHERE c.tip_mov ='+'
			AND c.tipo_doc = '85'
			AND c.estado= 'PENDIENTE'
			AND c.id = $valor");
			$stmt -> execute();
	
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT c.*,REPLACE(DATE_FORMAT(c.fecha_ven,'%d-%m-%Y'),'-','') AS fechaVen,REPLACE(c.num_cta,'-','') AS cuenta,cli.nombre,cli.ape_paterno,cli.ape_materno,cli.nombres,cli.documento FROM $tabla c 
			LEFT JOIN clientesjf cli ON c.cliente=cli.codigo
			WHERE c.tip_mov ='+'
			AND c.tipo_doc = '85'
			AND c.estado= 'PENDIENTE'
			AND c.estado_doc IS NULL ");
	
	
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

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND tip_mov = '-'");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE tip_mov = '-' ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }
	
	
	static public function mdlMostrarCancelacion($tabla,$item,$valor){


		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND tip_mov = '-' ");

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
	ELIMINAR CUENTA
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

	/*=============================================
	ELIMINAR TIPO DE PAGO
	=============================================*/

	static public function mdlEliminarCuentaCancelacion($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE num_cta = :num_cta");

		$stmt -> bindParam(":num_cta", $datos, PDO::PARAM_STR);

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
												AND tip_mov ='+'
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
														AND tip_mov ='+' 
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

			$stmt = Conexion::conectar()->prepare("SELECT 
			c.*,cli.nombre,IFNULL(DATEDIFF(c.ult_pago, c.fecha_ven), 0) AS diferencia,
			DATE_FORMAT(c.fecha, '%d-%m-%Y')AS nuevaFecha, 
			DATE_FORMAT(c.fecha_ven, '%d-%m-%Y')AS nuevaFechaVen,
			DATE_FORMAT(c.ult_pago, '%d-%m-%Y')AS nuevaFechaPago  
			FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo 
			WHERE c.tip_mov ='+' AND c.$item = :$item ");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT 
			c.*,
			cli.nombre,
			IFNULL(DATEDIFF(c.ult_pago, c.fecha_ven), 0) AS diferencia,
			DATE_FORMAT(c.fecha, '%d-%m-%Y')AS nuevaFecha, 
			DATE_FORMAT(c.fecha_ven, '%d-%m-%Y')AS nuevaFechaVen,
			DATE_FORMAT(c.ult_pago, '%d-%m-%Y')AS nuevaFechaPago 
		  FROM
			cuenta_ctejf c 
			LEFT JOIN clientesjf cli 
			  ON c.cliente = cli.codigo 
		  WHERE c.tip_mov = '+' 
		  ORDER BY c.id ASC");
	
			$stmt -> execute();
	
			return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasCuentas($tabla, $ano){

		if($ano == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE c.tip_mov ='+'  AND YEAR(c.fecha) = YEAR(NOW()) ORDER BY c.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else {

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE YEAR(c.fecha) = '".$ano."' AND c.tip_mov ='+'");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasCuentasPendientes($tabla, $ano){

		if($ano == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE c.tip_mov ='+'  AND c.estado='PENDIENTE' ORDER BY c.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else {

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE YEAR(c.fecha) = '".$ano."' AND c.tip_mov ='+' AND c.estado='PENDIENTE' ");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasCuentasAprobadas($tabla, $ano){

		if($ano == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE c.tip_mov ='+' AND c.estado='CANCELADO' AND YEAR(c.fecha) = YEAR(NOW())  ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else{

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE YEAR(c.fecha) = '".$ano."' AND c.tip_mov ='+' AND c.estado='CANCELADO' ");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	static public function mdlMostrarCuentaCredito($tabla,$valor){


		$stmt = Conexion::conectar()->prepare("SELECT 
		c.cliente,
		SUM(monto) AS total_credito 
		FROM
			cuenta_ctejf c 
		WHERE c.cliente = :cliente
		AND c.tip_mov = '+'
		GROUP BY c.cliente ");

		$stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

    }

	static public function mdlMostrarCuentaDeuda($tabla,$valor){


		$stmt = Conexion::conectar()->prepare("SELECT 
		c.cliente,
		IFNULL(SUM(saldo),0) AS total_deuda
		FROM
			cuenta_ctejf c 
		WHERE c.cliente = :cliente
		AND c.estado = 'pendiente' 
		AND c.tip_mov = '+'
		GROUP BY c.cliente ");

		$stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;


    }


	static public function mdlMostrarCuentaDeudaVencida($tabla,$valor){


		$stmt = Conexion::conectar()->prepare("SELECT 
		c.cliente,
		IFNULL(SUM(saldo),0) AS total_vencido
		FROM
			cuenta_ctejf c 
		WHERE c.cliente = :cliente 
		AND c.estado = 'pendiente' 
		AND c.fecha_ven < NOW() 
		AND c.tip_mov = '+'
		GROUP BY c.cliente  ");

		$stmt -> bindParam(":cliente", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

    }


	/*=============================================
	RANGO FECHAS ENVIOS DE CUENTAS
	=============================================*/	

	static public function mdlRangoFechaEnvioCuentas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT e.*,u.nombre FROM $tabla e LEFT JOIN usuariosjf u ON e.usuario=u.id  ORDER BY e.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT e.*,u.nombre FROM $tabla e LEFT JOIN usuariosjf u ON e.usuario=u.id WHERE e.fecha like '%$fechaFinal%' ");

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

				$stmt = Conexion::conectar()->prepare("SELECT e.*,u.nombre FROM $tabla e LEFT JOIN usuariosjf u ON e.usuario=u.id  WHERE e.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' ");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT e.*,u.nombre FROM $tabla e LEFT JOIN usuariosjf u ON e.usuario=u.id  WHERE e.fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	CREAR ENVIO LETRA CABECERA
	=============================================*/

	static public function mdlIngresarEnvioLetra($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo,fecha,usuario,cantidad,archivo) VALUES (:codigo,:fecha,:usuario,:cantidad,:archivo)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":archivo", $datos["archivo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	} 

	/*=============================================
	CREAR ENVIO LETRA DETALLE
	=============================================*/

	static public function mdlIngresarEnvioLetraDetalle($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(num_cta,codigo) VALUES (:num_cta,:codigo)");

		$stmt->bindParam(":num_cta", $datos["num_cta"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	} 

}