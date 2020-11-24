<?php
require_once "conexion.php";

class ModeloPedidos{

    /*
    * MOSTRAR TEMPORAL CABECERA
    */
    static public function mdlMostrarTemporal($tabla, $valor){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE codigo = $valor ORDER BY id ASC");

        $stmt -> execute();

        return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}
    /*
    * MOSTRAR TEMPORAL CABECERA
    */
    static public function mdlMostrarTemporalTotal($valor){

        $stmt = Conexion::conectar()->prepare("SELECT
												dt.codigo,
												SUM(total) AS totalArt
											FROM
												detalle_temporal dt
											WHERE dt.codigo = $valor");

        $stmt -> execute();

        return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

    }

    /*
    * MOSTRAR DETALLE DE TEMPORAL
    */
	static public function mdlMostraDetallesTemporal($tabla, $valor){

		$sql="SELECT * FROM $tabla WHERE codigo=$valor ORDER BY id ASC";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}

    /*
	* GUARDAR DETALLE DE TEMPORAL
	*/
	static public function mdlGuardarTemporal($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo, cliente, vendedor, lista) VALUES (:codigo, :cliente, :vendedor, :lista)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);
		$stmt->bindParam(":lista", $datos["lista"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/*
	* GUARDAR DETALLE DE TEMPORAL
	*/
	static public function mdlGuardarTemporalDetalle($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo, articulo, cantidad, precio, total) VALUES (:codigo, :articulo, :cantidad, :precio, (:cantidad * :precio) )");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

    /*
    * ELIMINAR ARTICULO REPETIDO
    */
	static public function mdlEliminarDetalleTemporal($tabla, $eliminar){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE codigo = :codigo AND articulo = :articulo");

        $stmt -> bindParam(":codigo", $eliminar["codigo"], PDO::PARAM_INT);
        $stmt -> bindParam(":articulo", $eliminar["articulo"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

    }

    /*
    * ACTUALIZAR TALONARIO +1
    */
	static public function mdlActualizarTalonario(){

		$sql="UPDATE talonariosjf SET pedido = pedido+1";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		$stmt=null;

	}

    /*
    *ACTUALIZAR TOTALES DEL PEDIDO
    */
	static public function mdlActualizarTotalesPedido($datos){

		$sql="UPDATE
					temporaljf
				SET
					op_gravada = :op_gravada,
					descuento_total = :descuento_total,
					sub_total = :sub_total,
					igv = :impuesto,
					total = :total,
					condicion_venta = :condicion_venta,
					estado = 'GENERADO',
					usuario = :usuario
				WHERE codigo = :codigo";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":op_gravada", $datos["op_gravada"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento_total", $datos["descuento_total"], PDO::PARAM_STR);
		$stmt->bindParam(":sub_total", $datos["sub_total"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":condicion_venta", $datos["condicion_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

        if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;

    }


}