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

                /* 
                * ultimo codigo
                */
                $ult_codigo = ModeloCortes::mdlUltCodigo();
                //var_dump($ult_codigo[ult_codigo]);

            $datos = array( "usuario" => $_POST["usuario"],
                            "sector" => $_POST["nuevoSector"],
                            "trabajador" => $_POST["nuevoTrabajador"],
                            "articulo" => $_POST["nuevoArticulo"],
                            "operacion" => $_POST["nuevoCodOperacion"],
                            "cantidad" => $_POST["nuevoAlmCorte"],
                            "total_precio" => $_POST["precio_total"],
                            "total_tiempo" => $_POST["tiempo_total"],
                            "ult_codigo" => $ult_codigo["ult_codigo"]);
            //var_dump("datos", $datos);

            $respuesta = ModeloCortes::mdlMandarTaller($datos);

            if($respuesta == "ok"){

                $articulo = $_POST["nuevoArticulo"];
                $rpt_articulo = ModeloArticulos::mdlMostrarArticulos($articulo);
                //var_dump("rpt_articulo",$rpt_articulo["modelo"]);

                $trabajador = $_POST["nuevoTrabajador"];
                $rpt_trabajador = ModeloTrabajador::mdlMostrarTrabajador(null,null,$trabajador);
                //var_dump("nombre", $rpt_trabajador["nombre"]);

                $sector = $_POST["nuevoSector"];
                $rpt_sector = ModeloSectores::mdlMostrarSectores($sector);
                //var_dump("sector", $rpt_sector["sector"]);

                $operacion = ModeloOperaciones::mdlMostrarOperaciones('operacionesjf', 'codigo', $_POST["nuevoCodOperacion"]);
                //var_dump($operacion["nombre "]);

                $ult_codigo = ModeloCortes::mdlUltCodigo();
                //var_dump($ult_codigo["ult_codigo"]);



                $modelo = $rpt_articulo["modelo"];
                $nombre = $rpt_articulo["nombre"];
                $color = $rpt_articulo["color"];
                $talla = $rpt_articulo["talla"];
                $cant_taller= $_POST["nuevoAlmCorte"];
                
                $nom_trab = $rpt_trabajador["nombre"];
                $nom_sector = $rpt_sector["sector"];

                $cod_operacion = $_POST["nuevoCodOperacion"];
                $nom_operacion = $operacion["nombre"];

                $ultimo = $ult_codigo["ult_codigo"];

                echo'<script>
                    
                    window.open("vistas/reportes_ticket/produccion_ticket.php?articulo='.$articulo.'&ultimo='.$ultimo.'&modelo='.$modelo.'&nombre='.$nombre.'&color='.$color.'&talla='.$talla.'&cant_taller='.$cant_taller.'&nom_trab='.$nom_trab.'&nom_sector='.$nom_sector.'&cod_operacion='.$cod_operacion.'&nom_operacion='.$nom_operacion.'" ,"_blank");
                           
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