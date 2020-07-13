<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


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

        if(isset($_POST["nuevoSector"])){

            #var_dump("nuevoSector", $_POST["nuevoSector"]);
            /*
            * ACTUALIZAR LA CANTIDAD QUE QUEDA EN LA TABLA CORTE
            */
            $articulo = $_POST["nuevoArticulo"];
            $operacion = $_POST["nuevoCodOperacion"];
            $cantidad = $_POST["nuevoCorte"];

            ModeloCortes::mdlActualizarCorte($articulo, $operacion, $cantidad);

            /*
            * REGISTRAR LAS OPERACIONES MANDADAS A TALLER
            */
            $datos = array( "usuario" => $_POST["usuario"],
                            "sector" => $_POST["nuevoSector"],
                            "trabajador" => $_POST["nuevoTrabajador"],
                            "articulo" => $_POST["nuevoArticulo"],
                            "operacion" => $_POST["nuevoCodOperacion"],
                            "cantidad" => $_POST["nuevoAlmCorte"],
                            "total_precio" => $_POST["precio_total"],
                            "total_tiempo" => $_POST["tiempo_total"]);
            #var_dump("datos", $datos);

            $respuesta = ModeloCortes::mdlMandarTaller($datos);

            if($respuesta == "ok"){

				$impresora = "cannon_20";

				$conector = new WindowsPrintConnector($impresora);

				$imprimir = new Printer($conector);

				$imprimir -> text("Hola Mundo"."\n");

				$imprimir -> cut();

				$imprimir -> close();

                echo'<script>

                    swal({
                          type: "success",
                          title: "Se mando a taller correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "en-cortes";

                                    }
                                })

                    </script>';

            }


        }

    }

}