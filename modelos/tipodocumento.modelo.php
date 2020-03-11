<?php

require_once "conexion.php";

class ModeloTipoDocumento{

    /*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarTipoDocumento($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

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
	CREAR CATEGORIA
	=============================================*/

	static public function mdlIngresarTipoDocumento($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo_doc) VALUES (:tipo_doc)");

		$stmt->bindParam(":tipo_doc ", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }

}
