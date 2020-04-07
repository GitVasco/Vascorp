<?php
require_once "conexion.php";

class ModeloCortes{

	/*
	* Método para mostrar los cortes
	*/
	static public function mdlMostrarCortes($valor1, $valor2){

        if($valor1 == null){

            $stmt = Conexion::conectar()->prepare("SELECT 
                    a.articulo,
                    m.marca,
                    a.modelo,
                    a.nombre,
                    a.cod_color,
                    a.color,
                    a.cod_talla,
                    a.talla,
                    a.alm_corte,
                    od.cod_operacion,
                    o.nombre as operacion,
                    od.precio_doc,
                    od.tiempo_stand
                FROM
                    articulojf a
                        LEFT JOIN
                    operaciones_detallejf od ON a.modelo = od.modelo
                        LEFT JOIN
                    operacionesjf o ON od.cod_operacion = o.codigo
                        LEFT JOIN
                    marcasjf m ON a.id_marca = m.id
                WHERE
                    a.alm_corte > 0");

			$stmt -> execute();

			return $stmt -> fetchAll();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT
                    a.articulo,
                    m.marca,
                    a.modelo,
                    a.nombre,
                    a.cod_color,
                    a.color,
                    a.cod_talla,
                    a.talla,
                    a.alm_corte,
                    od.cod_operacion,
                    o.nombre AS operacion,
                    od.precio_doc,
                    od.tiempo_stand,
                    od.precio_doc,
                    od.tiempo_stand
                FROM
                    articulojf a
                        LEFT JOIN
                    operaciones_detallejf od ON a.modelo = od.modelo
                        LEFT JOIN
                    operacionesjf o ON od.cod_operacion = o.codigo
                        LEFT JOIN
                    marcasjf m ON a.id_marca = m.id
                WHERE
                    a.articulo = :valor1
                        AND od.cod_operacion = :valor2
                        AND a.alm_corte > 0");

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



}