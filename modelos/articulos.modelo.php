<?php

require_once "conexion.php";

class ModeloArticulos
{

	/* 
	* MOSTRAR ARTICULOS
	*/
	static public function mdlMostrarArticulos($valor){

		if ($valor != null) {

			$stmt = Conexion::conectar()->prepare("CALL sp_1036_consulta_articulos_p(:valor)");

			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("CALL sp_1037_consulta_articulos()");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}

	/*
	* MOSTRAR CANTIDAD DE PEDIDOS
	*/
	static public function mdlArticulosPedidos(){

		$stmt = Conexion::conectar()->prepare("CALL sp_1038_pedidos_unidades()");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}

	/*
	* MOSTRAR CANTIDAD DE FALTANTES
	*/
	static public function mdlArticulosFaltantes($tabla){

		$stmt = Conexion::conectar()->prepare("CALL sp_1039_faltantes_unidades()");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}

	/*
	* MOSTRAR ARTICULOS PENDIENTES DE TARJETAS
	*/
	static public function mdlMostrarSinTarjeta(){

		$stmt = Conexion::conectar()->prepare("CALL sp_1040_articulos_sin_tarjeta()");

		$stmt->execute();

		return $stmt->fetchAll();


		$stmt->close();

		$stmt = null;
	}

	/*
	* REGISTRO DE ARTICULO
	*/
	static public function mdlIngresarArticulo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("CALL sp_1041_insert_articulos_p(:articulo, :id_marca,:marca, :modelo, :nombre, :cod_color, :color, :cod_talla, :talla)");

		$stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_color", $datos["cod_color"], PDO::PARAM_STR);
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_talla", $datos["cod_talla"], PDO::PARAM_STR);
		$stmt->bindParam(":talla", $datos["talla"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/* 
	* Método para activar y desactivar un usuario
	*/
	static public function mdlActualizarArticulo($valor1, $valor2){

		$sql = "CALL sp_1042_update_articulos_estado_p(:estado, :valor)";

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
	* EDITAR ARTICULO
	*/
	static public function mdlEditarArticulo($datos){

		$stmt = Conexion::conectar()->prepare("CALL sp_1043_update_articulos_p(:nombre, :imagen, :valor)");

		$stmt->bindParam(":nombre", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":valor", $datos["articulo"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/* 
	* BORRAR ARTICULO
	*/
	static public function mdlEliminarArticulo($datos){

		$stmt = Conexion::conectar()->prepare("CALL sp_1044_delete_articulos_p(:valor)");

		$stmt->bindParam(":valor", $datos, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/* 
	* Método para actualizar un dato CON EL articulo
	*/
	static public function mdlActualizarUnDato($tabla, $item1, $valor1, $valor2){

		$sql = "UPDATE $tabla SET $item1=:$item1 WHERE articulo=:id";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":id", $valor2, PDO::PARAM_INT);

		$stmt->execute();

		$stmt = null;
	}

	/* 
	* METODO PARA VER LA CONFIGURACION DE LAS URGENCIAS
	*/
	static public function mdlConfiguracion(){

		$sql = "CALL sp_1045_consulta_urg_porc()";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}

	/* 
	* CONFIGURAR PORCENTAJE DE URGENCIAS
	*/
	static public function mdlConfigurarUrgencia($dato){

		$stmt = Conexion::conectar()->prepare("CALL sp_1046_update_urg_porc($dato)");

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA DE ORDENES DE CORTE
	*/
	static public function mdlMostrarArticulosUrgencia(){

		$stmt = Conexion::conectar()->prepare("CALL sp_1047_consulta_urgencia_articulos()");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
	}

	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA URGENCIA
	*/
	static public function mdlMostrarUrgencia($tabla, $valor){

		if ($valor == null) {

			$stmt = Conexion::conectar()->prepare("CALL sp_1048_cons_urg_art_porc()");

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("CALL sp_1036_consulta_articulos_p(:valor)");

			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		}

		$stmt->close();
		$stmt = null;
	}

	/* 
	* MOSTRAR EL DETALLE DE LAS URGENCIAS
	*/
	static public function mdlVisualizarUrgenciasDetalle($valor){

		$stmt = Conexion::conectar()->prepare("CALL sp_1049_detalle_mp_articulo_urg_p(:valor)");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}

	/* 
	* MOSTRAR ARTICULOS PARA PEDIDOS
	*/
	static public function mdlListaArticulosPedidos(){

		$sql="CALL sp_1050_mod_color_talla()";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}

	/* 
	* MOSTRAR COLORES
	*/
	static public function mdlVerColores($valor){

		$stmt = Conexion::conectar()->prepare("CALL sp_1051_mod_cant_col_tal_p(:valor)");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}	

	/* 
	* MOSTRAR ARTICULOS PARA PEDIDOS
	*/
	static public function mdlVerArticulos($valor){

		$stmt = Conexion::conectar()->prepare("CALL sp_1052_mod_articulos_p(:valor)");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}

	/* 
	* MOSTRAR PRECIOS
	*/
	static public function mdlVerPrecios($valor){

		$stmt = Conexion::conectar()->prepare("CALL sp_1053_mod_precio_p(:valor)");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt=null;

	}
	
}
