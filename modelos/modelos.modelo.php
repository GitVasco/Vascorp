<?php

require_once "conexion.php";

class ModeloModelos
{

	/* 
	* MOSTRAR MODELOS
	*/
	static public function mdlMostrarModelos($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT t.id_modelo,t.modelo,t.nombre,t.estado,t.tipo,t.linea,t.operaciones,t.imagen,m.marca FROM $tabla t LEFT JOIN marcasjf m on t.id_marca=m.id ORDER BY id_modelo DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}



	/*
	* REGISTRO DE MODELO
	*/
	static public function mdlIngresarModelo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(modelo,nombre,estado,tipo,imagen,id_marca) VALUES (:modelo,:nombre,:estado,:tipo, :imagen,:id_marca)");

		$stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/* 
	* EDITAR MODELO
	*/
	static public function mdlEditarModelo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET modelo = :modelo, nombre = :nombre, tipo = :tipo, imagen=:imagen, id_marca = :id_marca  WHERE modelo = :modelo");
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_INT);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}
		/* 
	* Método para activar y desactivar un MODELO
	*/
	static public function mdlActualizarModelo($tabla,$valor1, $valor2){

		$sql = "UPDATE $tabla SET estado = :estado WHERE modelo=:valor";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":estado", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":valor", $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt = null;
	}

	/* 
	* BORRAR MODELO
	*/
	static public function mdlEliminarModelo($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_modelo = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	MOSTRAR MODELOS CON ARTICULOS
	=============================================*/
	static public function mdlMostrarModeloArticulo($tabla,$item,$valor){

		$stmt = Conexion::conectar()->prepare("SELECT t.id_modelo,t.modelo,t.nombre,t.estado,t.tipo,t.linea,t.operaciones,t.imagen,a.color,a.talla FROM $tabla t LEFT JOIN articulojf a on t.modelo=a.modelo WHERE t.modelo = $valor");
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
}
