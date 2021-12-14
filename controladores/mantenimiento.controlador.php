<?php

class ControladorMantenimiento{

    //*MOSTRAR EQUIPOS
    static public function ctrMostrarEquipos($valor){

        $respuesta = ModeloMantenimiento::mdlMostrarEquipos($valor);

		return $respuesta;

    }

}