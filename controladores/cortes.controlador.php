<?php

class ControladorCortes{

    /* 
    * MOSTRAR DATOS DE ALMACEN DE CORTE
    */
    static public function ctrMostrarCortes($valor1, $valor2){

        $respuesta = ModeloCortes::mdlMostrarCortes($valor1, $valor2);

        return $respuesta;

    }

    /*
    * MOSTRAR TALLERES DISPONIBLES
    */
	static public function ctrMostrarTaller(){

		$respuesta = ModeloCortes::mdlMostrarTallerA();

		return $respuesta;

    }

    /*
    *MANDAR A CORTE A TALLER
    */
    static public function ctrMandarTaller(){

        if(isset($_POST["nuevoTaller"])){

            #var_dump("nuevoTaller", $_POST["nuevoTaller"]);
            /* 
            * ACTUALIZAR LA CANTIDAD
            */

            $datos = array( "usuario" => $_POST["usuario"],
                            "taller" => $_POST["nuevoTaller"],
                            "trabajador" => $_POST["nuevoTrabajador"],
                            "articulo" => $_POST["nuevoArticulo"],
                            "operacion" => $_POST["nuevoCodOperacion"],
                            "cantidad" => $_POST["nuevoAlmCorte"],
                            "precio_total" => $_POST["precio_total"],
                            "tiempo_total" => $_POST["tiempo_total"],
                            "nuevoCorte" => $_POST["nuevoCorte"]);

            var_dump("datos", $datos);

        }

    }

}