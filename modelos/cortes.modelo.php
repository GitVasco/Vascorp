<?php
require_once "conexion.php";

class ModeloCortes{

	/*
	* Método para mostrar los cortes
	*/
	static public function mdlMostrarCortes($valor1){

        if($valor1 == null){

            $stmt = Conexion::conectar()->prepare("SELECT 
                    a.articulo,
                    a.marca,
                    a.modelo,
                    a.nombre,
                    a.color,
                    a.talla,
                    a.alm_corte 
                FROM
                    articulojf a 
                WHERE a.alm_corte > 0");

			$stmt -> execute();

			return $stmt -> fetchAll();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT 
                        a.articulo,
                        a.marca,
                        a.modelo,
                        a.nombre,
                        a.color,
                        a.talla,
                        a.alm_corte 
                    FROM
                        articulojf a 
                    WHERE  a.articulo = :valor1");

			$stmt->bindParam(":valor1", $valor1, PDO::PARAM_STR);
            
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

		$stmt = Conexion::conectar()->prepare("INSERT INTO entallerjf (
                                                id_cabecera,
                                                articulo,
                                                cod_operacion,
                                                cantidad,
                                                usuario,
                                                total_precio,
                                                total_tiempo,
                                                codigo
                                            ) 
                                            (SELECT 
                                                :codigo,
                                                a.articulo,
                                                od.cod_operacion,
                                                :cantidad,
                                                :usuario,
                                                ((od.precio_doc) / 12) * :cantidad,
                                                ((od.tiempo_stand) / 60) * :cantidad,
                                                CONCAT(:codigo,od.cod_operacion) 
                                            FROM
                                                articulojf a 
                                                LEFT JOIN operaciones_detallejf od 
                                                ON a.modelo = od.modelo 
                                            WHERE articulo = :articulo)");

		$stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);


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
                                                IFNULL(MAX(id), 1000000) AS ult_codigo 
                                            FROM
                                                entaller_cabjf en");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

    }


	/*
	* REGISTRAR LO QUE SE MANDA A TALLER CABECERA
	*/
	static public function mdlMandarTallerCab($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO entaller_cabjf (articulo, usuario, cantidad) 
        VALUES
          (:articulo, :usuario, :cantidad) ");

		$stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);


		if ($stmt->execute()) {

            return "ok";
            
		} else {

            return "error";
            
		}

		$stmt->close();
		$stmt = null;
    }
    
	/*
	* MOSTRAR EN TALLERES
	*/
	static public function mdlMostrarEnTalleres($articulo){

		$stmt = Conexion::conectar()->prepare("SELECT 
                                a.modelo,
                                a.nombre,
                                a.color,
                                a.talla,
                                td.cantidad,
                                td.cod_operacion,
                                o.nombre AS operacion,
                                td.codigo 
                            FROM
                                entallerjf td 
                                LEFT JOIN operacionesjf o 
                                ON td.cod_operacion = o.codigo 
                                LEFT JOIN articulojf a 
                                ON td.articulo = a.articulo 
                            WHERE td.id_cabecera = :articulo");

        $stmt->bindParam(":articulo", $articulo, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

    }    

}