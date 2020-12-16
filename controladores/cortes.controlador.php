<?php

class ControladorCortes{

    /*
    * MOSTRAR DATOS DE ALMACEN DE CORTE
    */
    static public function ctrMostrarCortes($valor1){

        $respuesta = ModeloCortes::mdlMostrarCortes($valor1);

        return $respuesta;

    }

    /*
    * MOSTRAR DATOS DE ALMACEN DE CORTE -VERSION 2
    */
    static public function ctrMostrarCortesV(){

        $respuesta = ModeloCortes::mdlMostrarCortesV();

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

        if(isset($_POST["nuevoArticulo"])){

            /* 
            * Actualizamos la cantidad que queda en corte y pasa al taller en el articulo
            */
            $articulo  = $_POST["nuevoArticulo"];
            $cantidad =  $_POST["nuevoAlmCorte"];

            ModeloArticulos::mdlActualizarTallerCorte($articulo,$cantidad);

            /* 
            * registramos en la tabla taller cabecera para el código
            */
            $datosCab = array( "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["nuevoArticulo"],
                            "cantidad" => $_POST["nuevoAlmCorte"]);

            $respuestaCab = ModeloCortes::mdlMandarTallerCab($datosCab);

            if($respuestaCab == "ok"){

                /* 
                * ultimo codigo
                */
                $ult_codigo = ModeloCortes::mdlUltCodigo();
                //var_dump($ult_codigo[ult_codigo]);

                /* 
                * Registramos en la tabla taller detalle
                */
                $datos = array( "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["nuevoArticulo"],
                                "cantidad" => $_POST["nuevoAlmCorte"],
                                "codigo" => $ult_codigo["ult_codigo"]);
                //var_dump($datos);
                
                $respuesta = ModeloCortes::mdlMandarTaller($datos);

                if($respuesta == "ok"){

                    $cod = $ult_codigo["ult_codigo"];

                    echo'<script>
                    
                    window.open("vistas/reportes_ticket/produccion_ticket.php?codigo='.$cod.'" ,"_blank");
                           
                    </script>';

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

    /*
    * MOSTRAR TALLERES DISPONIBLES
    */
	static public function ctrMostrarEnTalleres($articulo){

		$respuesta = ModeloCortes::mdlMostrarEnTalleres($articulo);

		return $respuesta;

    }

}