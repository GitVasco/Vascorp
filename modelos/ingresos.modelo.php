<?php
   
   require_once "conexion.php";

class ModeloIngresos{

	static public function mdlMostarIngresos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT mc.*, s.nom_sector,u.nombre  FROM  $tabla mc LEFT JOIN sectorjf s on mc.taller = s.cod_sector LEFT JOIN usuariosjf u ON mc.usuario = u.id WHERE mc.$item = :$item ");

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
											guia,
											taller,
											documento,
											total,
											fecha,
											almacen
										) 
										VALUES
											(:tipo,
											:usuario,
											:guia,
											:taller,
											:documento,
											:total,
											:fecha,
											:almacen
											)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
        $stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_INT);
		$stmt->bindParam(":guia",$datos["guia"],PDO::PARAM_STR);
        $stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
        $stmt->bindParam(":documento",$datos["documento"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_INT);
		$stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
		$stmt->bindParam(":almacen",$datos["almacen"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}
	static public function mdlGuardarSegunda($tabla,$datos){

		$sql="INSERT INTO $tabla (			tipo,
											usuario,
											taller,
											guia,
											documento,
											total,
											fecha,
											almacen,
											trabajador
										) 
										VALUES
											(:tipo,
											:usuario,
											:taller,
											:guia,
											:documento,
											:total,
											:fecha,
											:almacen,
											:trabajador
											)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
        $stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_INT);
        $stmt->bindParam(":guia",$datos["guia"],PDO::PARAM_STR);
		$stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
        $stmt->bindParam(":documento",$datos["documento"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_INT);
		$stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
		$stmt->bindParam(":almacen",$datos["almacen"],PDO::PARAM_STR);
		$stmt->bindParam(":trabajador",$datos["trabajador"],PDO::PARAM_INT);

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
											cantidad,
											almacen,
											idcierre
										) 
										VALUES
											(
											:tipo,
											:documento,
											:taller,
											:fecha,
											:articulo,
											:cantidad,
											:almacen,
											:idcierre
											)";

		$stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
		$stmt->bindParam(":documento",$datos["documento"],PDO::PARAM_STR);
		$stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
        $stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
		$stmt->bindParam(":articulo",$datos["articulo"],PDO::PARAM_STR);
		$stmt->bindParam(":cantidad",$datos["cantidad"],PDO::PARAM_INT);
		$stmt->bindParam(":almacen",$datos["almacen"],PDO::PARAM_STR);
		$stmt->bindParam(":idcierre",$datos["idcierre"],PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}
	
	static public function mdlGuardarDetalleSegunda($tabla,$datos){

		$sql="INSERT INTO $tabla (
											tipo,
											documento,
											taller,
											fecha,
											articulo,
											cliente,
											cantidad,
											almacen,
											idcierre
										) 
										VALUES
											(
											:tipo,
											:documento,
											:taller,
											:fecha,
											:articulo,
											:cliente,
											:cantidad,
											:almacen,
											:idcierre
											)";

		$stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
		$stmt->bindParam(":documento",$datos["documento"],PDO::PARAM_STR);
		$stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
        $stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
		$stmt->bindParam(":articulo",$datos["articulo"],PDO::PARAM_STR);
		$stmt->bindParam(":cliente",$datos["cliente"],PDO::PARAM_STR);
		$stmt->bindParam(":cantidad",$datos["cantidad"],PDO::PARAM_INT);
		$stmt->bindParam(":almacen",$datos["almacen"],PDO::PARAM_STR);
		$stmt->bindParam(":idcierre",$datos["idcierre"],PDO::PARAM_INT);


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

		$sql="UPDATE $tabla SET usuario=:usuario, guia = :guia, taller=:taller, documento=:documento, total=:total, fecha=:fecha WHERE id=:id";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_INT);
		$stmt->bindParam(":guia",$datos["guia"],PDO::PARAM_STR);
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

	static public function mdlEditarSegunda($tabla,$datos){

		$sql="UPDATE $tabla SET usuario=:usuario, guia = :guia, taller=:taller, documento=:documento, total=:total, fecha=:fecha,trabajador=:trabajador WHERE id=:id";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_INT);
		$stmt->bindParam(":guia",$datos["guia"],PDO::PARAM_STR);
        $stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
		$stmt->bindParam(":documento",$datos["documento"],PDO::PARAM_STR);
		$stmt->bindParam(":trabajador",$datos["trabajador"],PDO::PARAM_INT);
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

	static public function mdlUltimoIngreso($tabla){

		$sql="SELECT COUNT(taller) + 1 AS ultimo_codigo FROM $tabla";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetch();

		$stmt=null;


	}
	
	//VISUALIZAR DETALLE INGRESO
	static public function mdlVisualizarIngresoDetalle($valor){
	
		if($valor!=null){
			$stmt = Conexion::conectar()->prepare("SELECT 
			m.documento,
			DATE(m.fecha) AS fechas,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color,
			se.cod_sector,
			se.nom_sector,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '1' 
				THEN m.cantidad 
				ELSE 0 
			  END
			),0) AS t1,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '2' 
				THEN m.cantidad 
				ELSE 0 
			  END
			),0) AS t2,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '3' 
				THEN m.cantidad 
				ELSE 0 
			  END
			),0) AS t3,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '4' 
				THEN m.cantidad 
				ELSE 0 
			  END
			),0) AS t4,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '5' 
				THEN m.cantidad 
				ELSE 0 
			  END
			),0) AS t5,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '6' 
				THEN m.cantidad 
				ELSE 0 
			  END
			),0) AS t6,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '7' 
				THEN m.cantidad 
				ELSE 0 
			  END
			),0) AS t7,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '8' 
				THEN m.cantidad 
				ELSE 0 
			  END
			),0) AS t8,
			FORMAT(SUM(m.cantidad),0) AS total 
		  FROM
			movimientosjf_2021 m 
			LEFT JOIN articulojf a 
			  ON m.articulo = a.articulo 
			LEFT JOIN sectorjf se 
			  ON LEFT(m.documento, 2) = se.cod_sector 
		  WHERE m.documento = :valor 
		  GROUP BY m.documento,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color");
	
			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
	
			$stmt->execute();
	
			return $stmt->fetchAll();
	
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT 
			m.documento,
			DATE(m.fecha) AS fechas,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color,
			se.cod_sector,
			se.nom_sector,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '1' 
				THEN m.cantidad 
				ELSE 0 
			  END
			),0) AS t1,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '2' 
				THEN m.cantidad 
				ELSE 0 
			  END
			),0) AS t2,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '3' 
				THEN m.cantidad 
				ELSE 0 
			  END
			),0) AS t3,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '4' 
				THEN m.cantidad 
				ELSE 0 
			  END
			),0) AS t4,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '5' 
				THEN m.cantidad 
				ELSE 0 
			  END
			),0) AS t5,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '6' 
				THEN m.cantidad 
				ELSE 0 
			  END
			),0) AS t6,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '7' 
				THEN m.cantidad 
				ELSE 0 
			  END
			),0) AS t7,
			FORMAT(SUM(
			  CASE
				WHEN a.cod_talla = '8' 
				THEN m.cantidad 
				ELSE 0 
			  END
			),0) AS t8,
			FORMAT(SUM(m.cantidad),0) AS total 
		  FROM
			movimientosjf_2021 m 
			LEFT JOIN articulojf a 
			  ON m.articulo = a.articulo 
			LEFT JOIN sectorjf se 
			  ON LEFT(m.documento, 2) = se.cod_sector 
		  GROUP BY m.documento,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color");
	
			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
	
			$stmt->execute();
	
			return $stmt->fetchAll();
	
		}
	
			
			$stmt=null;
	
		}


		static public function mdlRangoFechasVerIngresos($tabla, $fechaInicial, $fechaFinal){

			if($fechaInicial == "null"){
	
				$stmt = Conexion::conectar()->prepare("SELECT 
				m.documento,
				DATE(m.fecha) AS fechas,
				a.modelo,
				a.nombre,
				mc.guia,
				a.cod_color,
				a.color,
				se.cod_sector,
				se.nom_sector,
				FORMAT(
				  SUM(
					CASE
					  WHEN a.cod_talla = '1' 
					  THEN m.cantidad 
					  ELSE 0 
					END
				  ),
				  0
				) AS t1,
				FORMAT(
				  SUM(
					CASE
					  WHEN a.cod_talla = '2' 
					  THEN m.cantidad 
					  ELSE 0 
					END
				  ),
				  0
				) AS t2,
				FORMAT(
				  SUM(
					CASE
					  WHEN a.cod_talla = '3' 
					  THEN m.cantidad 
					  ELSE 0 
					END
				  ),
				  0
				) AS t3,
				FORMAT(
				  SUM(
					CASE
					  WHEN a.cod_talla = '4' 
					  THEN m.cantidad 
					  ELSE 0 
					END
				  ),
				  0
				) AS t4,
				FORMAT(
				  SUM(
					CASE
					  WHEN a.cod_talla = '5' 
					  THEN m.cantidad 
					  ELSE 0 
					END
				  ),
				  0
				) AS t5,
				FORMAT(
				  SUM(
					CASE
					  WHEN a.cod_talla = '6' 
					  THEN m.cantidad 
					  ELSE 0 
					END
				  ),
				  0
				) AS t6,
				FORMAT(
				  SUM(
					CASE
					  WHEN a.cod_talla = '7' 
					  THEN m.cantidad 
					  ELSE 0 
					END
				  ),
				  0
				) AS t7,
				FORMAT(
				  SUM(
					CASE
					  WHEN a.cod_talla = '8' 
					  THEN m.cantidad 
					  ELSE 0 
					END
				  ),
				  0
				) AS t8,
				FORMAT(SUM(m.cantidad), 0) AS total 
			  FROM
				movimientosjf_2021 m 
				LEFT JOIN articulojf a 
				  ON m.articulo = a.articulo 
				LEFT JOIN sectorjf se 
				  ON LEFT(m.documento, 2) = se.cod_sector 
				LEFT JOIN movimientos_cabecerajf mc 
				  ON m.tipo = mc.tipo 
				  AND m.documento = mc.documento 
			  WHERE m.tipo = 'E20' and YEAR(m.fecha)='2022'
			  GROUP BY m.documento,
				a.modelo,
				a.nombre,
				a.cod_color,
				a.color");
	
				$stmt -> execute();
	
				return $stmt -> fetchAll();	
	
	
			}else if($fechaInicial == $fechaFinal){
	
				$stmt = Conexion::conectar()->prepare("SELECT 
				m.documento,
				DATE(m.fecha) AS fechas,
				a.modelo,
				a.nombre,
				mc.guia,
				a.cod_color,
				a.color,
				se.cod_sector,
				se.nom_sector,
				FORMAT(
				  SUM(
					CASE
					  WHEN a.cod_talla = '1' 
					  THEN m.cantidad 
					  ELSE 0 
					END
				  ),
				  0
				) AS t1,
				FORMAT(
				  SUM(
					CASE
					  WHEN a.cod_talla = '2' 
					  THEN m.cantidad 
					  ELSE 0 
					END
				  ),
				  0
				) AS t2,
				FORMAT(
				  SUM(
					CASE
					  WHEN a.cod_talla = '3' 
					  THEN m.cantidad 
					  ELSE 0 
					END
				  ),
				  0
				) AS t3,
				FORMAT(
				  SUM(
					CASE
					  WHEN a.cod_talla = '4' 
					  THEN m.cantidad 
					  ELSE 0 
					END
				  ),
				  0
				) AS t4,
				FORMAT(
				  SUM(
					CASE
					  WHEN a.cod_talla = '5' 
					  THEN m.cantidad 
					  ELSE 0 
					END
				  ),
				  0
				) AS t5,
				FORMAT(
				  SUM(
					CASE
					  WHEN a.cod_talla = '6' 
					  THEN m.cantidad 
					  ELSE 0 
					END
				  ),
				  0
				) AS t6,
				FORMAT(
				  SUM(
					CASE
					  WHEN a.cod_talla = '7' 
					  THEN m.cantidad 
					  ELSE 0 
					END
				  ),
				  0
				) AS t7,
				FORMAT(
				  SUM(
					CASE
					  WHEN a.cod_talla = '8' 
					  THEN m.cantidad 
					  ELSE 0 
					END
				  ),
				  0
				) AS t8,
				FORMAT(SUM(m.cantidad), 0) AS total 
			  FROM
				movimientosjf_2021 m 
				LEFT JOIN articulojf a 
				  ON m.articulo = a.articulo 
				LEFT JOIN sectorjf se 
				  ON LEFT(m.documento, 2) = se.cod_sector 
				LEFT JOIN movimientos_cabecerajf mc 
				  ON m.tipo = mc.tipo 
				  AND m.documento = mc.documento 
				WHERE DATE(m.fecha) like '%$fechaFinal%'
				AND m.tipo = 'E20' 
				GROUP BY m.documento,
				a.modelo,
				a.nombre,
				a.cod_color,
				a.color");
	
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
	
					$stmt = Conexion::conectar()->prepare("SELECT 
					m.documento,
					DATE(m.fecha) AS fechas,
					a.modelo,
					a.nombre,
					mc.guia,
					a.cod_color,
					a.color,
					se.cod_sector,
					se.nom_sector,
					FORMAT(
					  SUM(
						CASE
						  WHEN a.cod_talla = '1' 
						  THEN m.cantidad 
						  ELSE 0 
						END
					  ),
					  0
					) AS t1,
					FORMAT(
					  SUM(
						CASE
						  WHEN a.cod_talla = '2' 
						  THEN m.cantidad 
						  ELSE 0 
						END
					  ),
					  0
					) AS t2,
					FORMAT(
					  SUM(
						CASE
						  WHEN a.cod_talla = '3' 
						  THEN m.cantidad 
						  ELSE 0 
						END
					  ),
					  0
					) AS t3,
					FORMAT(
					  SUM(
						CASE
						  WHEN a.cod_talla = '4' 
						  THEN m.cantidad 
						  ELSE 0 
						END
					  ),
					  0
					) AS t4,
					FORMAT(
					  SUM(
						CASE
						  WHEN a.cod_talla = '5' 
						  THEN m.cantidad 
						  ELSE 0 
						END
					  ),
					  0
					) AS t5,
					FORMAT(
					  SUM(
						CASE
						  WHEN a.cod_talla = '6' 
						  THEN m.cantidad 
						  ELSE 0 
						END
					  ),
					  0
					) AS t6,
					FORMAT(
					  SUM(
						CASE
						  WHEN a.cod_talla = '7' 
						  THEN m.cantidad 
						  ELSE 0 
						END
					  ),
					  0
					) AS t7,
					FORMAT(
					  SUM(
						CASE
						  WHEN a.cod_talla = '8' 
						  THEN m.cantidad 
						  ELSE 0 
						END
					  ),
					  0
					) AS t8,
					FORMAT(SUM(m.cantidad), 0) AS total 
				  FROM
					movimientosjf_2021 m 
					LEFT JOIN articulojf a 
					  ON m.articulo = a.articulo 
					LEFT JOIN sectorjf se 
					  ON LEFT(m.documento, 2) = se.cod_sector 
					LEFT JOIN movimientos_cabecerajf mc 
					  ON m.tipo = mc.tipo 
					  AND m.documento = mc.documento 
					WHERE DATE(m.fecha) BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'
					AND m.tipo = 'E20' 
				  GROUP BY m.documento,
					a.modelo,
					a.nombre,
					a.cod_color,
					a.color");
	
				}else{
	
	
					$stmt = Conexion::conectar()->prepare("SELECT 
					m.documento,
					DATE(m.fecha) AS fechas,
					a.modelo,
					a.nombre,
					mc.guia,
					a.cod_color,
					a.color,
					se.cod_sector,
					se.nom_sector,
					FORMAT(
					  SUM(
						CASE
						  WHEN a.cod_talla = '1' 
						  THEN m.cantidad 
						  ELSE 0 
						END
					  ),
					  0
					) AS t1,
					FORMAT(
					  SUM(
						CASE
						  WHEN a.cod_talla = '2' 
						  THEN m.cantidad 
						  ELSE 0 
						END
					  ),
					  0
					) AS t2,
					FORMAT(
					  SUM(
						CASE
						  WHEN a.cod_talla = '3' 
						  THEN m.cantidad 
						  ELSE 0 
						END
					  ),
					  0
					) AS t3,
					FORMAT(
					  SUM(
						CASE
						  WHEN a.cod_talla = '4' 
						  THEN m.cantidad 
						  ELSE 0 
						END
					  ),
					  0
					) AS t4,
					FORMAT(
					  SUM(
						CASE
						  WHEN a.cod_talla = '5' 
						  THEN m.cantidad 
						  ELSE 0 
						END
					  ),
					  0
					) AS t5,
					FORMAT(
					  SUM(
						CASE
						  WHEN a.cod_talla = '6' 
						  THEN m.cantidad 
						  ELSE 0 
						END
					  ),
					  0
					) AS t6,
					FORMAT(
					  SUM(
						CASE
						  WHEN a.cod_talla = '7' 
						  THEN m.cantidad 
						  ELSE 0 
						END
					  ),
					  0
					) AS t7,
					FORMAT(
					  SUM(
						CASE
						  WHEN a.cod_talla = '8' 
						  THEN m.cantidad 
						  ELSE 0 
						END
					  ),
					  0
					) AS t8,
					FORMAT(SUM(m.cantidad), 0) AS total 
				  FROM
					movimientosjf_2021 m 
					LEFT JOIN articulojf a 
					  ON m.articulo = a.articulo 
					LEFT JOIN sectorjf se 
					  ON LEFT(m.documento, 2) = se.cod_sector 
					LEFT JOIN movimientos_cabecerajf mc 
					  ON m.tipo = mc.tipo 
					  AND m.documento = mc.documento 
					WHERE DATE(m.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'
					AND m.tipo = 'E20' 
					GROUP BY m.documento,
					a.modelo,
					a.nombre,
					a.cod_color,
					a.color ");
	
				}
			
				$stmt -> execute();
	
				return $stmt -> fetchAll();
	
			}
	
		}


	//*ACTUALIZAR FECHA
	static public function mdlActualizarFecha($datos){

		$sql="UPDATE 
					movimientos_cabecerajf mc 
					LEFT JOIN movimientosjf_2021 m 
					ON mc.tipo = m.tipo 
					AND mc.documento = m.documento SET mc.fecha = :fecha,
					m.fecha = :fecha 
				WHERE mc.tipo = :tipo 
					AND mc.documento = :documento";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":tipo",$datos["tipo"],PDO::PARAM_INT);
		$stmt->bindParam(":documento",$datos["documento"],PDO::PARAM_STR);
		$stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt=null;
		
	}


}