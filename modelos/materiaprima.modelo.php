<?php

require_once "conexion.php";

class ModeloMateriaPrima{

	/* 
	* MOSTRAR DATOS DE LA MATERIA PRIMA
	*/
	static public function mdlMostrarMateriaPrima($valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("CALL sp_1028_consulta_mp_p($valor)");

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("CALL sp_1029_consulta_mp()");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }    
    
	/* 
	* EDITAR NOMBRE DE LA MATERIA PRIMA
	*/
	static public function mdlEditarMateriaPrima($datos){

		$stmt = Conexion::conectar()->prepare("CALL sp_1030_update_mp_p(:descripcion, :valor)");

		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":valor", $datos["codpro"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt -> close();
		$stmt = null;

	}
	
	/* 
	* Método para vizualizar detalle de la materia prima
	*/
	static public function mdlVisualizarMateriaPrimaDetalle($valor){

		$sql="CALL sp_1031_articulos_x_mp_p($valor)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}
	
	/* 
	* EDITAR COSTO DE LA MATERIA PRIMA
	*/
	static public function mdlEditarMateriaPrimaCosto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("CALL sp_1032_update_mp_costo_p(:cospro,:valor)");

		$stmt->bindParam(":cospro", $datos["cospro"], PDO::PARAM_STR);
		$stmt->bindParam(":valor", $datos["codpro"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt -> close();
		$stmt = null;

	}
	
	/* 
	* MOSTRAR MATERIA PRIMA PARA LA TABLA URGENCIA
	*/
	static public function mdlMostrarUrgenciaAMP($valor){

		if ($valor == null) {

			$stmt = Conexion::conectar()->prepare("CALL sp_1033_mp_urgencias()");

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("CALL sp_1028_consulta_mp_p($valor)");

			$stmt->execute();

			return $stmt->fetch();
		}

		$stmt->close();
		$stmt = null;
	}
	
	/* 
	* MOSTRAR EL DETALLE DE LAS URGENCIAS TABLA ORDEN DE COMPRA
	*/
	static public function mdlVisualizarUrgenciasAMPDetalleOC($valor){

		$sql="CALL sp_1034_mp_en_oc_p($valor)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}
	
	/* 
	* MOSTRAR EL DETALLE DE LAS URGENCIAS TABLA ORDEN DE COMPRA
	*/
	static public function mdlVisualizarUrgenciasAMPDetalleART($valor){

		$sql="CALL sp_1035_art_mp_urg_p($valor)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}	


}