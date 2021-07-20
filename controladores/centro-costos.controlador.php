<?php

class ControladorCentroCostos{

    /*
	*MOSTRAR AREAS
	*/
	static public function ctrMostrarAreas($valor){

		$respuesta = ModeloCentroCostos::mdlMostrarAreas($valor);

		return $respuesta;

    }

    /* 
    *Mostrar centro de costos
    */
	static public function ctrMostrarCentroCostos($valor){

		$respuesta = ModeloCentroCostos::mdlMostrarCentroCostos($valor);

		return $respuesta;

    }

    /* 
    *Mostrar Correlativo
    */
	static public function ctrMostrarCorrelativo($tipoGasto, $area){

		$respuesta = ModeloCentroCostos::mdlMostrarCorrelativo($tipoGasto, $area);

		return $respuesta;

    }    

    /* 
    *CREAR CENTRO DE COSTOS
    */
	static public function ctrCrearCentroCostos(){

        if(isset($_POST["nuevoCod"])){

            # traemos la fecha y la pc
            date_default_timezone_set('America/Lima');
            $fecha = new DateTime();
            $PcReg= gethostbyaddr($_SERVER['REMOTE_ADDR']);

            $codigo = substr($_POST["nuevoCod"],-2);
            #var_dump($codigo);
            if($codigo == "01"){

                $datos = array( "tipo_gasto"    =>  $_POST["tipoGasto"],
                                "cod_area"      =>  $_POST["Area"],
                                "cod_caja"      =>  $_POST["nuevoCod"],
                                "descripcion"   =>  $_POST["nuevoCC"],
                                "fecmod"		=>  $fecha->format("Y-m-d H:i:s"),
                                "usumod"		=>  $_SESSION["nombre"],
                                "pcmod" 		=>  $PcReg);
                #var_dump($datos);

                $respuesta = ModeloCentroCostos::mdlActualizarACentroCostos($datos);
                #var_dump($respuesta);

                if($respuesta == "ok"){

                    ModeloCentroCostos::mdlPonerNombres();

                    # Mostramos una alerta suave
                    echo '<script>
                            swal({
                                type: "success",
                                title: "Felicitaciones",
                                text: "¡El centro de costos fue registrado con éxito!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then((result)=>{
                                if(result.value){
                                    window.location="centro-costos";}
                            });
                        </script>';	
    
                }else{
    
                    # Mostramos una alerta suave
                    echo '<script>
                            swal({
                                type: "error",
                                title: "Error",
                                text: "¡La información presento problemas y no se registro adecuadamente. Por favor, intenteló de nuevo!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then((result)=>{
                                if(result.value){
                                    window.location="centro-costos";}
                            });
                        </script>';
        
                }                

            }else{

                $datos = array( "tipo_gasto"    =>  $_POST["tipoGasto"],
                                "cod_area"      =>  $_POST["Area"],
                                "cod_caja"      =>  $_POST["nuevoCod"],
                                "descripcion"   =>  $_POST["nuevoCC"],
                                "fecreg"		=>  $fecha->format("Y-m-d H:i:s"),
                                "usureg"		=>  $_SESSION["nombre"],
                                "pcreg" 		=>  $PcReg);
                #var_dump($datos);

                $respuesta = ModeloCentroCostos::mdlCrearCentroCostos($datos);
                #var_dump($respuesta);

                if($respuesta == "ok"){

                    ModeloCentroCostos::mdlPonerNombres();

                    # Mostramos una alerta suave
                    echo '<script>
                            swal({
                                type: "success",
                                title: "Felicitaciones",
                                text: "¡El centro de costos fue registrado con éxito!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then((result)=>{
                                if(result.value){
                                    window.location="centro-costos";}
                            });
                        </script>';	

                }else{

                    # Mostramos una alerta suave
                    echo '<script>
                            swal({
                                type: "error",
                                title: "Error",
                                text: "¡La información presento problemas y no se registro adecuadamente. Por favor, intenteló de nuevo!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then((result)=>{
                                if(result.value){
                                    window.location="centro-costos";}
                            });
                        </script>';
        
                }

            }

        }

    }      

    /*
	*MOSTRAR GASTOS DE CAJA
	*/
	static public function ctrMostrarGastosCaja(){

		$respuesta = ModeloCentroCostos::mdlMostrarGastosCaja();

		return $respuesta;

    }

    /* 
    *Mostrar centro de costos con codigo de caja
    */
	static public function ctrMostrarCentroCostosCaja(){

		$respuesta = ModeloCentroCostos::mdlMostrarCentroCostosCaja();

		return $respuesta;

    }    

    /* 
    *Mostrar Correlativo
    */
	static public function ctrMostrarTipoDoc(){

		$respuesta = ModeloCentroCostos::mdlMostrarTipoDoc();

		return $respuesta;

    }    

}