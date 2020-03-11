<?php
class ControladorAlmacenCorte{

    /* 
    * SACAR EL ULTIMO CODIGO
    */
    static public function ctrUltimoCodigoAC(){

        $respuesta = ModeloAlmacenCorte::mdlUltimoCodigoAC();

        return $respuesta;

    }



}