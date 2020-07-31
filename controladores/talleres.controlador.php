<?php

class ControladorTalleres{

    /*
    * MOSTRAR DATOS DE TALLERES GENERAL
    */
    static public function ctrMostrarTalleresG($valor){

        $respuesta = ModeloTalleres::mdlMostrarTalleresG($valor);

        return $respuesta;

    }

    /*
    * MOSTRAR DATOS DE TALLERES PROCESO
    */
    static public function ctrMostrarTalleresP(){

        $respuesta = ModeloTalleres::mdlMostrarTalleresP();

        return $respuesta;

    }

    /*
    * MOSTRAR DATOS DE TALLERES TERMINADO
    */
    static public function ctrMostrarTalleresT(){

        $respuesta = ModeloTalleres::mdlMostrarTalleresT();

        return $respuesta;

    }
    
    /* 
    * ACTUALIZAR A EN PROCESO
    */
    static public function ctrProceso(){

        if(isset($_POST["codigoBarra"])){

            $cobar = $_POST["codigoBarra"];

            $validar = ModeloTalleres::mdlMostrarTalleresG($cobar);
            //var_dump("fecha_proceso", $validar["fecha_proceso"]);

            if($validar["fecha_proceso"] == null){

                # Actualizamos ultima_compra en la tabla Clientes
                date_default_timezone_set('America/Lima');
                $fecha = date('Y-m-d G:i:s');
                //var_dump($fecha);

                $codigo = $_POST["codigoBarra"];

                $respuesta = ModeloTalleres::mdlProceso($fecha,$codigo);

                if($respuesta == "ok"){

                    echo'<script>

                                        window.location = "marcar-taller";

                        </script>';

                }
                

            }else{

                # Actualizamos ultima_compra en la tabla Clientes
                date_default_timezone_set('America/Lima');
                $fecha = date('Y-m-d G:i:s');
                //var_dump($fecha);

                $codigo = $_POST["codigoBarra"];

                $respuesta = ModeloTalleres::mdlTerminado($fecha,$codigo);

                if($respuesta == "ok"){

                    echo'<script>

                        swal({
                            type: "success",
                            title: "El articulo ha sido guardado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                        if (result.value) {

                                        window.location = "marcar-taller";

                                        }
                                    })

                        </script>';

                }


            }




        }





    }

}