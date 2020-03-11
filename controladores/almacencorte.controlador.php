<?php
class ControladorAlmacenCorte{

    /* 
    * SACAR EL ULTIMO CODIGO
    */
    static public function ctrUltimoCodigoAC(){

        $respuesta = ModeloOrdenCorte::mdlUltimoCodigoOC($tabla);

        return $respuesta;

    }



}