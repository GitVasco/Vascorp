<?php
require_once "conexion.php";

class ModeloCortes{

	/*
	* Método para mostrar los cortes
	*/
	static public function mdlMostrarCortes($valor1, $valor2){

        if($valor1 == null){

            $stmt = Conexion::conectar()->prepare("SELECT
                    ec.articulo,
                    m.marca,
                    a.modelo,
                    a.nombre,
                    a.cod_color,
                    a.color,
                    a.cod_talla,
                    a.talla,
                    ec.cantidad,
                    ec.cod_operacion,
                    o.nombre as operacion,
                    ec.precio_doc,
                    ec.tiempo_stand
                FROM
                    encortejf ec
                        LEFT JOIN
                    articulojf a ON ec.articulo = a.articulo
                        LEFT JOIN
                    operacionesjf o ON ec.cod_operacion = codigo
                        LEFT JOIN
                    marcasjf m ON a.id_marca = m.id
                WHERE
                    ec.cantidad > 0");

			$stmt -> execute();

			return $stmt -> fetchAll();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT
                    ec.articulo,
                    m.marca,
                    a.modelo,
                    a.nombre,
                    a.cod_color,
                    a.color,
                    a.cod_talla,
                    a.talla,
                    ec.cantidad,
                    ec.cod_operacion,
                    o.nombre AS operacion,
                    ec.precio_doc,
                    ec.tiempo_stand
                FROM
                    encortejf ec
                        LEFT JOIN
                    articulojf a ON ec.articulo = a.articulo
                        LEFT JOIN
                    operacionesjf o ON ec.cod_operacion = codigo
                        LEFT JOIN
                    marcasjf m ON a.id_marca = m.id
                WHERE
                    ec.cantidad > 0
                        AND ec.articulo = :valor1
                        AND ec.cod_operacion = :valor2");

			$stmt->bindParam(":valor1", $valor1, PDO::PARAM_STR);
            $stmt->bindParam(":valor2", $valor2, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

        }

		$stmt -> close();

		$stmt = null;

    }

	/*
	* MOSTRAR TALLERES
	*/
	static public function mdlMostrarTallerA(){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM tallerjf");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

    }

    /*
    *ACTUALIZAR LA NUEVA CANTIDAD EN LA TABLA CORTE
    */
	static public function mdlActualizarCorte($articulo, $operacion, $cantidad){

		$stmt = Conexion::conectar()->prepare("UPDATE encortejf
                                                SET
                                                    cantidad = :cantidad,
                                                    total_precio = (precio_doc / 12) * cantidad,
                                                    total_tiempo = (tiempo_stand / 60) * cantidad
                                                WHERE
                                                    articulo = :articulo
                                                        AND cod_operacion = :operacion");

		$stmt->bindParam(":articulo", $articulo, PDO::PARAM_STR);
        $stmt->bindParam(":operacion", $operacion, PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_STR);

		$stmt->execute();

		$stmt = null;

    }

	/*
	* REGISTRAR LO QUE SE MANDA A TALLER
	*/
	static public function mdlMandarTaller($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO entallerjf
                                                (   sector,
                                                    articulo,
                                                    cod_operacion,
                                                    trabajador,
                                                    cantidad,
                                                    usuario,
                                                    total_precio,
                                                    total_tiempo,
                                                    codigo)
                                                    VALUES
                                                (   :sector,
                                                    :articulo,
                                                    :operacion,
                                                    :trabajador,
                                                    :cantidad,
                                                    :usuario,
                                                    :total_precio,
                                                    :total_tiempo,
                                                    (:codigo+1))");

		$stmt->bindParam(":sector", $datos["sector"], PDO::PARAM_STR);
		$stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
		$stmt->bindParam(":operacion", $datos["operacion"], PDO::PARAM_STR);
		$stmt->bindParam(":trabajador", $datos["trabajador"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":total_precio", $datos["total_precio"], PDO::PARAM_STR);
        $stmt->bindParam(":total_tiempo", $datos["total_tiempo"], PDO::PARAM_STR);
        $stmt->bindParam(":codigo", $datos["ult_codigo"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}
	/*
	* ULTIMO CODIGO
	*/
	static public function mdlUltCodigo(){

		$stmt = Conexion::conectar()->prepare("SELECT 
                                                    MAX(codigo) AS  ult_codigo
                                                FROM
                                                    entallerjf en");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

    }

}