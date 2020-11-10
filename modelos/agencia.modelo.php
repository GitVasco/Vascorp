<?php

require_once "conexion.php";

class ModeloAgencias{

	/*=============================================
	CREAR COLOR
	=============================================*/

	static public function mdlIngresarAgencia($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre,ruc,direccion,ubigeo) VALUES (:nombre,:ruc,:direccion,:ubigeo)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":ubigeo", $datos["ubigeo"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    

	/*=============================================
	MOSTRAR COLORES
	=============================================*/

	static public function mdlMostrarAgencias($tabla,$valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where $valor =:valor)");

			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }
    
	/*=============================================
	EDITAR COLOR
	=============================================*/

	static public function mdlEditarAgencia($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET (:codigo, :color, :valor)");

		$stmt->bindParam(":valor", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
	
	
	/*=============================================
	ELIMINAR COLOR
	=============================================*/

	static public function mdlEliminarColor($datos){

		$stmt = Conexion::conectar()->prepare("CALL sp_1022_delete_colores_p(:valor)");

		$stmt -> bindParam(":valor", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}    

}