<?php

require_once "conexion.php";

class ModeloProduccion
{

	/* 
	* MOSTRAR PRODUCCION
	*/
	static public function mdlMostrarQuincenas($valor){

		if ($valor != null) {

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                        * 
                                                    FROM
                                                        quincenasjf 
                                                    WHERE id = :valor");

			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                    q.id,
                                                    q.ano,
                                                    m.mes,
                                                    CASE
                                                    WHEN q.quincena = '1' 
                                                    THEN '1ra Quincena' 
                                                    ELSE '2da Quincena' 
                                                    END AS quincena,
                                                    q.inicio,
                                                    q.fin,
                                                    u.nombre,
                                                    q.fecha_creacion 
                                                FROM
                                                    quincenasjf q 
                                                    LEFT JOIN usuariosjf u 
                                                    ON q.usuario = u.id 
                                                    LEFT JOIN 
                                                    (SELECT DISTINCT 
                                                        codigo,
                                                        descripcion AS mes 
                                                    FROM
                                                        meses) AS m 
                                                    ON q.mes = m.codigo");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
    }

	/*
	* CREAR QUINCENA
	*/
	static public function mdlCrearQuincenas($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO quincenasjf (
                                                ano,
                                                mes,
                                                quincena,
                                                inicio,
                                                fin,
                                                usuario
                                            ) 
                                            VALUES
                                                (
                                                :ano,
                                                :mes,
                                                :quincena,
                                                :inicio,
                                                :fin,
                                                :usuario
                                                )");

		$stmt->bindParam(":ano", $datos["ano"], PDO::PARAM_STR);
		$stmt->bindParam(":mes", $datos["mes"], PDO::PARAM_STR);
		$stmt->bindParam(":quincena", $datos["quincena"], PDO::PARAM_STR);
		$stmt->bindParam(":inicio", $datos["inicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fin", $datos["fin"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}    
    
}