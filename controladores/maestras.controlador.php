<?php

class ControladorMaestras{

    /* 
    * LISTAR TABLA CABECERA
    */
    static public function ctrMostrarMaestrasCabecera(){

        $respuesta = ModeloMaestras::mdlMostrarMaestrasCabecera();

        return $respuesta;

    }

    /* 
    * LISTAR TABLA DETALLE
    */
    static public function ctrMostrarMaestrasDetalle($valor){

        $respuesta = ModeloMaestras::mdlMostrarMaestrasDetalle($valor);

        return $respuesta;

    }    

    /* 
    * MOSTRAR CORRELATIVO
    */
    static public function ctrMostrarCorrelativo($valor){

        $respuesta = ModeloMaestras::mdlMostrarCorrelativo($valor);

        return $respuesta;

    }      

    /* 
    * MOSTRAR SUBLINEAS
    */
    static public function ctrMostrarSubLineas(){

        $respuesta = ModeloMaestras::mdlMostrarSubLineas();

        return $respuesta;

    }   
    
    /* 
    * MOSTRAR CORRELATIVO SUBLINEA
    */
    static public function ctrMostrarCorrelativoSubLinea($valor){

        $respuesta = ModeloMaestras::mdlMostrarCorrelativoSubLinea($valor);

        return $respuesta;

    }     

    /* 
    * MOSTRAR SUBLINEA
    */
    static public function ctrMostrarSubLineaEditar($valor, $valor1){

        $respuesta = ModeloMaestras::mdlMostrarSubLineaEditar($valor, $valor1);

        return $respuesta;

    } 

    /* 
    * CREAR SUB LINEA
    */
    static public function ctrCrearSubLinea(){

        if(isset($_POST["nuevoCodTabla"])){

            if($_POST["nuevaDescCortaA"] == ""){

                $des_corta = $_POST["nuevaDescCorta"];

            }else{

                $des_corta = $_POST["nuevaDescCortaA"];

            }

            //var_dump($des_corta);

            date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$PcReg= gethostbyaddr($_SERVER['REMOTE_ADDR']);

            $datos = array( "cod_argumento" => $_POST["nuevoCorrelativo"],
                            "cod_local" => "01",
                            "cod_entidad" => "01",
                            "cod_tabla" => $_POST["nuevoCodTabla"],
                            "des_larga" => $_POST["nuevaDescLarga"],
                            "des_corta" => $des_corta,
                            "valor_1" => $_POST["nuevoVal1"],
                            "valor_2" => $_POST["nuevoVal2"],
                            "valor_3" => $_POST["nuevoVal3"],
                            "valor_4" => $_POST["nuevoVal4"],
                            "valor_5" => $_POST["nuevoVal5"],
                            "fecreg" => $fecha -> format("Y-m-d H:i:s"),
                            "usureg" => $_SESSION["nombre"],
                            "pcreg" => $PcReg);

            //var_dump($datos);
            $respuesta = ModeloMaestras::ctrCrearSubLinea($datos);
            //$respuesta = "ok";         
            
            if($respuesta == "ok"){

                echo'<script>

                swal({
                    type: "success",
                    title: "Se creado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                                if (result.value) {

                                window.location = "tabla-maestra";

                                }
                            })

                </script>';

            }else{

                echo'<script>

                swal({
                    type: "warning",
                    title: "no se puedo guardar",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                                if (result.value) {

                                window.location = "tabla-maestra";

                                }
                            })

                </script>';

            }

        }

    }

/* 
    * EDITAR SUB LINEA
    */
    static public function ctrEditarSubLinea(){

        if(isset($_POST["editarCodTabla"])){

            date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$PcReg= gethostbyaddr($_SERVER['REMOTE_ADDR']);

            $datos = array( "cod_tabla" => $_POST["editarCodTabla"],
                            "cod_argumento" => $_POST["editarCorrelativo"],
                            "des_larga" => $_POST["editarDescLarga"],
                            "des_corta" => $_POST["editarDescCorta"],
                            "valor_1" => $_POST["editarVal1"],
                            "valor_2" => $_POST["editarVal2"],
                            "valor_3" => $_POST["editarVal3"],
                            "valor_4" => $_POST["editarVal4"],
                            "valor_5" => $_POST["editarVal5"],
                            "fecmod" => $fecha -> format("Y-m-d H:i:s"),
                            "usumod" => $_SESSION["nombre"],
                            "pcmod" => $PcReg);   
                            
            //var_dump($datos);   
            $respuesta = ModeloMaestras::mdlEditarSubLinea($datos);     
            //var_dump($respuesta); 
            
            if($respuesta == "ok"){

                echo'<script>

                swal({
                    type: "success",
                    title: "Se edito correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                                if (result.value) {

                                window.location = "tabla-maestra";

                                }
                            })

                </script>';

            }else{

                echo'<script>

                swal({
                    type: "warning",
                    title: "no se puedo editar",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                                if (result.value) {

                                window.location = "tabla-maestra";

                                }
                            })

                </script>';

            }            

        }

    }    

    /* 
    * LISTAR TABLA CABECERA
    */
    static public function ctrMostrarProdCabecera(){

        $respuesta = ModeloMaestras::mdlMostrarProdCabecera();

        return $respuesta;

    }

}