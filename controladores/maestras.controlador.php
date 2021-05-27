<?php

class ControladorMaestras{

    /* 
    * LISTAR TABLA CABECERA
    */
    static public function ctrMostrarMaestrasCabecera(){

        $respuesta = ModeloMaestras::mdlMostrarMaestrasCabecera();

        return $respuesta;

    }

    /* 
    * LISTAR TABLA DETALLE
    */
    static public function ctrMostrarMaestrasDetalle($valor){

        $respuesta = ModeloMaestras::mdlMostrarMaestrasDetalle($valor);

        return $respuesta;

    }    

}