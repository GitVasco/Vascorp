<?php
class ControladorCortes{

    /* 
    * MOSTRAR DATOS DE ALMACEN DE CORTE
    */
    static public function ctrMostrarCortes(){

        $respuesta = ModeloCortes::mdlMostrarCortes();

        return $respuesta;

    }




}