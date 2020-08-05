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
    * MOSTRAR DATOS DE TALLERES TERMINADO GENERAL
    */
    static public function ctrMostrarTalleresTerminado($valor){

        $respuesta = ModeloTalleres::mdlMostrarTalleresTerminado($valor);

        return $respuesta;

    }

    /*
    * MOSTRAR DATOS DE TALLERES PROCESO 5 LINEAS
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

                                        window.location = "marcar-taller";

                        </script>';

                }

            }

        }

    }


	/* 
	* Asignar codigo de barra a trabajador
	*/

	static public function ctrAsignarTrabajador(){

		if(isset($_POST["cod_tra"])){

            $codigo = $_POST["codigoBarra"];
            $cod_tra = $_POST["cod_tra"];

            $respuesta = ModeloTalleres::mdlAsignarTrabajador($codigo, $cod_tra);

            if($respuesta == "ok"){

                echo'<script>

                    window.location = "en-tallert";

                </script>';

            }

		}

	}    

}