<?php

class ControladorProduccion{

    /* 
    *MOSTRAR QUINCENAS
    */
    static public function ctrMostrarQuincenas($valor){

		$respuesta = ModeloProduccion::mdlMostrarQuincenas($valor);

		return $respuesta;

	}

	/* 
	* CREAR QUINCENA
	*/
	static public function ctrCrearQuincenas(){

        if(isset($_POST["mes"])){

            $datos = array( "ano" => $_POST["año"],
                            "mes" => $_POST["mes"],
                            "quincena" => $_POST["quincena"],
                            "inicio" => $_POST["inicio"],
                            "fin" => $_POST["fin"],
                            "usuario" => $_POST["usuario"]);
            //var_dump($datos);

            $respuesta = ModeloProduccion::mdlCrearQuincenas($datos);
                
            if($respuesta == "ok"){

                echo'<script>

                    swal({
                          type: "success",
                          title: "La quincena ha sido guardada correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "quincena";

                                    }
                                })

                    </script>';

            }  


		}

    }
    
    /* 
    *EDITAR QUINCENA
    */

	static public function ctrEditarQuincenas(){

		if(isset($_POST["editarMes"])){

            $datos = array( "ano" => $_POST["año"],
                            "mes" => $_POST["mes"],
                            "quincena" => $_POST["quincena"],
                            "inicio" => $_POST["inicio"],
                            "fin" => $_POST["fin"],
                            "usuario" => $_POST["usuario"]);
            //var_dump($datos);

            $respuesta = ModeloProduccion::mdlCrearQuincenas($datos);



		}

    }    

}