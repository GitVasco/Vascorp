<?php

class ControladorMaestras{

    /* 
    * LISTAR TABLA CABECERA
    */
    static public function ctrMostrarMaestrasCabecera(){

        $respuesta = ModeloMaestras::mdlMostrarMaestrasCabecera();

        return $respuesta;

    }

}