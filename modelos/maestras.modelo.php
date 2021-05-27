<?php

require_once "conexion.php";

class ModeloMaestras{

    /* 
    * LISTAR TABLA CABECERA
    */
    static public function mdlMostrarMaestrasCabecera(){

        $stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
                                                cod_tabla,
                                                descripcion,
                                                lon_campo,
                                                tip_campo,
                                                tip_generacion 
                                            FROM
                                                Tabla_M_Maestra 
                                            WHERE Estado = '1' AND cod_tabla NOT IN ('INVI')
                                            ORDER BY Descripcion ASC");

        $stmt -> execute();

        return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

    }

    /* 
    * LISTAR TABLA DETALLE
    */
    static public function mdlMostrarMaestrasDetalle($valor){

        $stmt = Conexion::conectar()->prepare("SELECT 
                                                    cod_tabla,
                                                    cod_argumento,
                                                    des_larga,
                                                    des_corta,
                                                    valor_1,
                                                    valor_2,
                                                    valor_3,
                                                    valor_4,
                                                    valor_5,
                                                    valor_6,
                                                    valor_7,
                                                    valor_8,
                                                    valor_9 
                                                FROM
                                                    tabla_m_detalle 
                                                WHERE cod_Tabla = :valor");

        $stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

    }    


}