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
                                            WHERE Estado = '1' 
                                            ORDER BY Descripcion ASC");

        $stmt -> execute();

        return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

    }


}