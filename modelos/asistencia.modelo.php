<?php

require_once "conexion.php";

class ModeloAsistencias{

	/*=============================================
	CREAR Asistencia
	=============================================*/

	static public function mdlIngresarAsistencia($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_trabajador) VALUES (:id_trabajador)");

		$stmt->bindParam(":id_trabajador", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }

	/*=============================================
	MOSTRAR AsistenciaS
	=============================================*/

	static public function mdlMostrarAsistencias($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT a.*, t.nom_tra,t.ape_pat_tra,t.ape_mat_tra,p.nombre FROM $tabla a LEFT JOIN trabajadorjf t ON a.id_trabajador=t.cod_tra LEFT JOIN parajf p ON a.id_para=p.id WHERE a.id = :id");

			$stmt -> bindParam(":id", $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare(
				"SELECT a.*, t.nom_tra,t.ape_pat_tra,t.ape_mat_tra,p.nombre FROM $tabla a LEFT JOIN trabajadorjf t ON a.id_trabajador=t.cod_tra
				LEFT JOIN parajf p ON a.id_para=p.id");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR Asistencia
	=============================================*/

	static public function mdlEditarAsistencia($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET minutos = :minutos, id_para = :id_para, tiempo_para = :tiempo_para WHERE id = :id");

		$stmt -> bindParam(":minutos", $datos["minutos"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_para", $datos["id_para"], PDO::PARAM_INT);
		$stmt -> bindParam(":tiempo_para", $datos["tiempo_para"], PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR Asistencia
	=============================================*/

	static public function mdlEditarExtra($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET minutos = :minutos,  horas_extras = :horas_extras WHERE id = :id");

		$stmt -> bindParam(":minutos", $datos["minutos"], PDO::PARAM_INT);
		$stmt -> bindParam(":horas_extras", $datos["horas_extras"], PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	
	/*=============================================
	APROBAR Asistencia
	=============================================*/

	static public function mdlActualizarAsistencia($tabla, $valor1,$valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE id = :id");

		$stmt -> bindParam(":estado", $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor2, PDO::PARAM_INT);
		

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}	


	/*=============================================
	MOSTRAR Presente
	=============================================*/

	static public function mdlMostrarPresente($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT DISTINCT DATE(FECHA) as fecha FROM asistenciasjf WHERE DATE(FECHA)= DATE(NOW())");


		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

    
}
    