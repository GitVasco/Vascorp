<?php
   
   require_once "conexion.php";

class ModeloIngresos{

	static public function mdlMostarIngresos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT 
															mc.*,u.nombre
														FROM
															movimientos_cabecerajf mc 
															LEFT JOIN usuariosjf u 
																ON oc.usuario = u.id");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;		


	}

	static public function mdlMostarDetallesIngresos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;		


	}
 
	/* 
	* Guardar cabecera de ORDENES DE CORTE
	*/
	static public function mdlGuardarIngreso($tabla,$datos){

		$sql="INSERT INTO $tabla (			tipo,
											usuario,
											taller,
											documento,
											total,
											fecha
										) 
										VALUES
											(:tipo,
											:usuario,
											:taller,
											:documento,
											:total,
											:fecha
											)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
        $stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_INT);
        $stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
        $stmt->bindParam(":documento",$datos["documento"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_INT);
		$stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}

	/* 
	* Guardar cabecera de ORDENES DE CORTE
	*/
	static public function mdlGuardarDetalleIngreso($tabla,$datos){

		$sql="INSERT INTO $tabla (
											tipo,
											documento,
											taller,
											fecha,
											articulo,
											cantidad
										) 
										VALUES
											(
											:tipo,
											:documento,
											:taller,
											:fecha,
											:articulo,
											:cantidad
											)";

		$stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
		$stmt->bindParam(":documento",$datos["documento"],PDO::PARAM_STR);
		$stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
        $stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
		$stmt->bindParam(":articulo",$datos["articulo"],PDO::PARAM_STR);
		$stmt->bindParam(":cantidad",$datos["cantidad"],PDO::PARAM_INT);
		


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}
	
	
	/* 
	* Método para editar las ventas
	*/
	static public function mdlEditarIngreso($tabla,$datos){

		$sql="UPDATE $tabla SET usuario=:usuario, taller=:taller, documento=:documento, total=:total, fecha=:fecha WHERE id=:id";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_INT);
        $stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
        $stmt->bindParam(":documento",$datos["documento"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_INT);
        $stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
        $stmt->bindParam(":id",$datos["id"],PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt=null;
		
	}

/* 
	* Método para eliminar los detalles de los ingresos
	*/
	static public function mdlEliminarDato($tabla,$item,$valor){

		$sql="DELETE FROM $tabla WHERE $item=:$item";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";
		
		}else{

			return "error";
		
		}

		$stmt=null;
	}

	/* 
	* Método para eliminar la orden de corte
	*/
	static public function mdlEliminarIngreso($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = $valor");

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
	


/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasIngresos($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT mc.*,u.nombre FROM movimientos_cabecerajf mc LEFT JOIN usuariosjf u ON mc.usuario=u.id ORDER BY mc.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT mc.*,u.nombre FROM movimientos_cabecerajf mc LEFT JOIN usuariosjf u ON mc.usuario=u.id WHERE mc.fecha like '%$fechaFinal%'");

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

				$stmt = Conexion::conectar()->prepare("SELECT mc.*,u.nombre FROM movimientos_cabecerajf mc LEFT JOIN usuariosjf u ON mc.usuario=u.id WHERE mc.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT mc.*,u.nombre FROM movimientos_cabecerajf mc LEFT JOIN usuariosjf u ON mc.usuario=u.id WHERE mc.fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}
	

}