<?php

require_once "conexion.php";

class ModeloMantenimiento{

    //*MOSTRAR EQUIPOS
    static public function mdlMostrarEquipos($valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE c.tip_mov ='+' AND c.$item = :$item ");

			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                    e.id,
                                                    e.cod_global,
                                                    e.cod_tipo,
                                                    e.cod_tip_maquina,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TDMV' 
                                                    AND t.cod_argumento = e.cod_tip_maquina) AS nombre_tipo_maquina,
                                                    e.descripcion,
                                                    e.cod_ubicacion,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TUBI' 
                                                    AND t.cod_argumento = e.cod_ubicacion) AS ubicacion_maquina,
                                                    e.cod_marca_equi,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TMAR' 
                                                    AND t.cod_argumento = e.cod_marca_equi) AS marca_equipo,
                                                    e.modelo_equipo,
                                                    e.serie_equipo,
                                                    e.cod_tipo_motor,
                                                    e.cod_marca_motor,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TMAR' 
                                                    AND t.cod_argumento = e.cod_marca_motor) AS marca_motor,
                                                    e.modelo_motor,
                                                    e.serie_motor,
                                                    e.cod_marca_caja,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TMAR' 
                                                    AND t.cod_argumento = e.cod_marca_caja) AS marca_caja,
                                                    e.modelo_caja,
                                                    e.serie_caja,
                                                    e.observaciones,
                                                    e.estado 
                                                FROM
                                                    equipos_jf e 
                                                ORDER BY e.cod_tipo");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

}