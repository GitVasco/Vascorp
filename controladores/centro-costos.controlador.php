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
    *Mostrar centro de costos
    */
	static public function ctrMostrarCentroCostosResumen($valor){

		$respuesta = ModeloCentroCostos::mdlMostrarCentroCostosResumen($valor);

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
	static public function ctrMostrarGastosCaja($mes){

		$respuesta = ModeloCentroCostos::mdlMostrarGastosCaja($mes);

		return $respuesta;

    }

    /*
	*MOSTRAR GASTOS DE CAJA
	*/
	static public function ctrMostrarGastosCajaId($id){

		$respuesta = ModeloCentroCostos::mdlMostrarGastosCajaId($id);

		return $respuesta;

    }    

    /*
	*MOSTRAR GASTOS DE CAJA
	*/
	static public function ctrMostrarIngresosCajaId($id){

		$respuesta = ModeloCentroCostos::mdlMostrarIngresosCajaId($id);

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

    /* 
    *CREAR GASTOS
    */
	static public function ctrCrearGastosCaja(){

        if(isset($_POST["nuevoCodCaja"])){

            $fechaGasto = $_POST["fechaGasto"];
            $mesGasto = date("m", strtotime($fechaGasto));
            #var_dump((int)$mesGasto);

            $saldos = ModeloMaestras::mdlTraerSaldos((int)$mesGasto);
            #var_dump($saldos["estado"]);

            if($saldos["estado"] == "CER"){

                # Mostramos una alerta suave
                echo '<script>
                        swal({
                            type: "error",
                            title: "Error",
                            text: "¡No es posible registrar gastos en un mes cerrado!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result)=>{
                            if(result.value){
                                window.location="gastos-caja";}
                        });
                    </script>';

            }else{

                # traemos la fecha y la pc
                date_default_timezone_set('America/Lima');
                $fecha = new DateTime();
                $PcReg= gethostbyaddr($_SERVER['REMOTE_ADDR']);

                $datos = array( "fecha"             =>  $_POST["fechaGasto"],
                                "recibo"            =>  $_POST["recibo"],
                                "ruc_proveedor"     =>  $_POST["nuevoRucProC"],
                                "proveedor"         =>  $_POST["nuevaRazPro"],
                                "sucursal"          =>  $_POST["nuevaSucursal"],
                                "cod_caja"          =>  $_POST["nuevoCodCaja"],
                                "total"             =>  $_POST["total"],
                                "tipo_documento"    =>  $_POST["nuevoTipo"],
                                "documento"         =>  $_POST["documento"],
                                "solicitante"       =>  $_POST["solicitante"],
                                "descripcion"       =>  $_POST["descripcion"],
                                "rubro_cancelacion" =>  $_POST["rubro"],
                                "observacion"       =>  $_POST["observacion"],
                                "fecreg"		    =>  $fecha->format("Y-m-d H:i:s"),
                                "usureg"		    =>  $_SESSION["nombre"],
                                "pcreg" 		    =>  $PcReg);
                #var_dump($datos);

                $respuesta = ModeloCentroCostos::mdlCrearGastosCaja($datos);
                #var_dump($respuesta);

                if($respuesta == "ok"){
                    
                    $fecha = $_POST["fechaGasto"];
                    $egreso = $_POST["total"];

                    $datosM = array("fecha"     => $fecha,
                                    "egreso"    => $egreso);

                    #var_dump($datosM);
                    ModeloCentroCostos::mdlActualizarEgresosA($datosM);
                    #var_dump($respuestaG);

                    # Mostramos una alerta suave
                    echo '<script>
                            swal({
                                type: "success",
                                title: "Felicitaciones",
                                text: "¡El gasto fue registrado con éxito!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then((result)=>{
                                if(result.value){
                                    window.location="gastos-caja";}
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
                                    window.location="gastos-caja";}
                            });
                        </script>';
        
                }                

            }

        }

    }

    /* 
    *CREAR GASTOS
    */
	static public function ctrEditarGastosCaja(){

        if(isset($_POST["id"])){

            $fechaGasto = $_POST["editarFechaGasto"];
            $mesGasto = date("m", strtotime($fechaGasto));
            #var_dump((int)$mesGasto);

            $saldos = ModeloMaestras::mdlTraerSaldos((int)$mesGasto);
            #var_dump($saldos["estado"]);

            if($saldos["estado"] == "CER"){

                # Mostramos una alerta suave
                echo '<script>
                        swal({
                            type: "error",
                            title: "Error",
                            text: "¡No es posible editar gastos en un mes cerrado!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result)=>{
                            if(result.value){
                                window.location="gastos-caja";}
                        });
                    </script>';

            }else{

                # traemos la fecha y la pc
                date_default_timezone_set('America/Lima');
                $fecha = new DateTime();
                $PcReg= gethostbyaddr($_SERVER['REMOTE_ADDR']);

                $datos = array( "id"                =>  $_POST["id"],
                                "fecha"             =>  $_POST["editarFechaGasto"],
                                "recibo"            =>  $_POST["editarRecibo"],
                                "ruc_proveedor"     =>  $_POST["editarRucProC"],
                                "proveedor"         =>  $_POST["editarRazPro"],
                                "sucursal"          =>  $_POST["editarSucursal"],
                                "cod_caja"          =>  $_POST["editarCodCaja"],
                                "total"             =>  $_POST["editarTotal"],
                                "tipo_documento"    =>  $_POST["editarTipo"],
                                "documento"         =>  $_POST["editarDocumentoG"],
                                "solicitante"       =>  $_POST["editarSolicitante"],
                                "descripcion"       =>  $_POST["editarDescripcion"],
                                "rubro_cancelacion" =>  $_POST["editarRubro"],
                                "observacion"       =>  $_POST["editarObservacion"],
                                "fecmod"		    =>  $fecha->format("Y-m-d H:i:s"),
                                "usumod"		    =>  $_SESSION["nombre"],
                                "pcmod" 		    =>  $PcReg);
                #var_dump($datos);

                $respuesta = ModeloCentroCostos::mdlEditarGastosCaja($datos);
                #var_dump($respuesta);

                if($respuesta == "ok"){

                    $fecha = $_POST["editarFechaGasto"];
                    $nuevo = $_POST["editarTotal"];
                    $antiguo = $_POST["totalAntiguo"];

                    $datosM = array("fecha"     => $fecha,
                                    "nuevo"     => $nuevo,
                                    "antiguo"   => $antiguo);

                    #var_dump($datosM);
                    $respuestaG = ModeloCentroCostos::mdlActualizarEgresosB($datosM);
                    #var_dump($respuestaG);

                    # Mostramos una alerta suave
                    echo '<script>
                            swal({
                                type: "success",
                                title: "Felicitaciones",
                                text: "¡El gasto fue editado con éxito!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then((result)=>{
                                if(result.value){
                                    window.location="gastos-caja";}
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
                                    window.location="gastos-caja";}
                            });
                        </script>';
        
                }

            }            

        }

    }  
    
    /* 
    *ANULAR GASTO
    */
	static public function ctrAnularGasto(){

        if(isset($_GET["idGasto"])){

            $id = $_GET["idGasto"];
            #var_dump($id);

            $gasto = ModeloCentroCostos::mdlMostrarGastosCajaId($id);
            #var_dump($gasto["fecha"]);

            $fechaGasto = $gasto["fecha"];
            $mesGasto = date("m", strtotime($fechaGasto));
            #var_dump((int)$mesGasto);

            $saldos = ModeloMaestras::mdlTraerSaldos((int)$mesGasto);
            #var_dump($saldos["estado"]); 

            if($saldos["estado"] == "CER"){

                # Mostramos una alerta suave
                echo '<script>
                    swal({
                        type: "error",
                        title: "Error",
                        text: "¡No es posible eliminar gastos en un mes cerrado!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then((result)=>{
                        if(result.value){
                            window.location="gastos-caja";}
                    });
                </script>';

            }else{

                # traemos la fecha y la pc
                date_default_timezone_set('America/Lima');
                $fecha = new DateTime();
                $PcReg= gethostbyaddr($_SERVER['REMOTE_ADDR']);

                $datos = array( "id"        => $id, 
                                "fecanu"    =>  $fecha->format("Y-m-d H:i:s"),
                                "usuanu"	=>  $_SESSION["nombre"],
                                "pcanu" 	=>  $PcReg);
                #var_dump($datos);

                $respuesta = ModeloCentroCostos::mdlAnularGastosCaja($datos);
                #var_dump($respuesta);

                if($respuesta == "ok"){
                    
                    $fecha = $gasto["fecha"];
                    $egreso = $gasto["total"];

                    $datosM = array("fecha"     => $fecha,
                                    "egreso"    => $egreso);

                    #var_dump($datosM);
                    ModeloCentroCostos::mdlActualizarEgresosC($datosM);
                    #var_dump($respuestaG);
                    
                    echo'<script>

                    swal({
                        type: "success",
                        title: "El gasto ha sido anulada correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        }).then(function(result){
                                    if (result.value) {

                                    window.location = "gastos-caja";

                                    }
                                })

                    </script>';

                }

            }


        }

    }    

    /* 
    *Mostrar Correlativo
    */
	static public function ctrMostrarMeses(){

		$respuesta = ModeloCentroCostos::mdlMostrarMeses();

		return $respuesta;

    }     

    /* 
    * CERRAR MES
    */    
    static public function ctrCerrarMesG(){

        if(isset($_POST["mesCerrar"])){

            $mes = $_POST["mesCerrar"];

            $respuesta = ModeloCentroCostos::mdlCerrarMes($mes);
            #var_dump($respuesta);

            $datosMes = ModeloMaestras::mdlTraerSaldos($mes);
            #var_dump($datosMes);

            $saldo_actual = $datosMes["actual"];
            #var_dump($saldo_actual);

            $abrirMes = ModeloCentroCostos::mdlAbrirMes($mes, $saldo_actual);
            #var_dump($abrirMes);

            if($abrirMes == "ok"){

                $mesAbierto = ModeloMaestras::mdlTraerSaldos($mes+1);
                var_dump($mesAbierto);

                echo'<script>

				swal({
					  type: "success",
					  title: "Se abrio '.$mesAbierto["nom_mes"].' con saldo inicial de S/ '.$mesAbierto["saldo_inicial"].'",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "gastos-caja";

								}
							})

				</script>';


            }


        }

    }

    /* 
    * CERRAR MES
    */    
    static public function ctrCerrarMesI(){

        if(isset($_POST["mesCerrar"])){

            $mes = $_POST["mesCerrar"];

            $respuesta = ModeloCentroCostos::mdlCerrarMes($mes);
            #var_dump($respuesta);

            $datosMes = ModeloMaestras::mdlTraerSaldos($mes);
            #var_dump($datosMes);

            $saldo_actual = $datosMes["actual"];
            #var_dump($saldo_actual);

            $abrirMes = ModeloCentroCostos::mdlAbrirMes($mes, $saldo_actual);
            #var_dump($abrirMes);

            if($abrirMes == "ok"){

                $mesAbierto = ModeloMaestras::mdlTraerSaldos($mes+1);
                var_dump($mesAbierto);

                echo'<script>

				swal({
					  type: "success",
					  title: "Se abrio '.$mesAbierto["nom_mes"].' con saldo inicial de S/ '.$mesAbierto["saldo_inicial"].'",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "ingresos-caja";

								}
							})

				</script>';


            }


        }

    }    

    /*
	*MOSTRAR INGRESOS DE CAJA
	*/
	static public function ctrMostrarIngresosCaja($mes){

		$respuesta = ModeloCentroCostos::mdlMostrarIngresosCaja($mes);

		return $respuesta;

    }  
    
    /*
	*MOSTRAR INGRESOS DE CAJA
	*/
	static public function ctrMostrarIngresosVendedor($mes){

		$respuesta = ModeloCentroCostos::mdlMostrarIngresosVendedor($mes);

		return $respuesta;

    }
    
    /* 
    *CREAR INGRESOS
    */
	static public function ctrCrearIngresosCaja(){

        if(isset($_POST["nuevoCodIng"])){

            $fechaIngreso = $_POST["fechaIngreso"];
            $mesIngreso = date("m", strtotime($fechaIngreso));
            #var_dump((int)$mesIngreso);

            $saldos = ModeloMaestras::mdlTraerSaldos((int)$mesIngreso);
            #var_dump($saldos["estado"]);

            if($saldos["estado"] == "CER"){

                # Mostramos una alerta suave
                echo '<script>
                        swal({
                            type: "error",
                            title: "Error",
                            text: "¡No es posible registrar ingresos en un mes cerrado!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result)=>{
                            if(result.value){
                                window.location="ingresos-caja";}
                        });
                    </script>';

            }else{

                # traemos la fecha y la pc
                date_default_timezone_set('America/Lima');
                $fecha = new DateTime();
                $PcReg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
                
                $datos = array( "fecha"             =>  $_POST["fechaIngreso"],
                                "cod_ingreso"       =>  $_POST["nuevoCodIng"],
                                "cod_responsable"   =>  $_POST["nuevoResp"],
                                "tipo_documento"    =>  $_POST["nuevoTipo"],
                                "documento"         =>  $_POST["documento"],
                                "total"             =>  $_POST["nuevoTotal"],
                                "observacion"       =>  $_POST["observacion"],
                                "fecreg"		    =>  $fecha->format("Y-m-d H:i:s"),
                                "usureg"		    =>  $_SESSION["nombre"],
                                "pcreg" 		    =>  $PcReg);
                #var_dump($datos);
                
                $respuesta = ModeloCentroCostos::mdlCrearIngresosCaja($datos);
                #var_dump($respuesta);     
                
                if($respuesta == "ok"){
                    
                    $fecha = $_POST["fechaIngreso"];
                    $ingreso = $_POST["nuevoTotal"];

                    $datosM = array("fecha"     => $fecha,
                                    "ingreso"   => $ingreso);

                    #var_dump($datosM);
                    ModeloCentroCostos::mdlActualizarIngresosA($datosM);
                    #var_dump($respuestaG);

                    # Mostramos una alerta suave
                    echo '<script>
                            swal({
                                type: "success",
                                title: "Felicitaciones",
                                text: "¡El ingreso fue registrado con éxito!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then((result)=>{
                                if(result.value){
                                    window.location="ingresos-caja";}
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
                                    window.location="ingresos-caja";}
                            });
                        </script>';
        
                }                


            }            

        }

    }    

    /* 
    *CREAR GASTOS
    */
	static public function ctrEditarIngresosCaja(){

        if(isset($_POST["id"])){

            $fechaIngreso = $_POST["editarFechaIngreso"];
            $mesIngreso = date("m", strtotime($fechaIngreso));
            var_dump((int)$mesIngreso);

            $saldos = ModeloMaestras::mdlTraerSaldos((int)$mesIngreso);
            var_dump($saldos["estado"]);

            if($saldos["estado"] == "CER"){

                # Mostramos una alerta suave
                echo '<script>
                        swal({
                            type: "error",
                            title: "Error",
                            text: "¡No es posible editar gastos en un mes cerrado!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result)=>{
                            if(result.value){
                                window.location="gastos-caja";}
                        });
                    </script>';

            }else{

                # traemos la fecha y la pc
                date_default_timezone_set('America/Lima');
                $fecha = new DateTime();
                $PcReg= gethostbyaddr($_SERVER['REMOTE_ADDR']);

                $datos = array( "id"                =>  $_POST["id"],
                                "fecha"             =>  $_POST["editarFechaIngreso"],
                                "cod_ingreso"       =>  $_POST["editarCodIng"],
                                "cod_responsable"   =>  $_POST["editarResp"],
                                "tipo_documento"    =>  $_POST["editarTipo"],
                                "documento"         =>  $_POST["editarDocumentoI"],
                                "total"             =>  $_POST["editarTotal"],
                                "observacion"       =>  $_POST["editarObservacion"],
                                "fecmod"		    =>  $fecha->format("Y-m-d H:i:s"),
                                "usumod"		    =>  $_SESSION["nombre"],
                                "pcmod" 		    =>  $PcReg);
                #var_dump($datos);

                $respuesta = ModeloCentroCostos::mdlEditarIngresosCaja($datos);
                #var_dump($respuesta);

                if($respuesta == "ok"){

                    $fecha = $_POST["editarFechaIngreso"];
                    $nuevo = $_POST["editarTotal"];
                    $antiguo = $_POST["totalAntiguo"];

                    $datosM = array("fecha"     => $fecha,
                                    "nuevo"     => $nuevo,
                                    "antiguo"   => $antiguo);

                    var_dump($datosM);
                    $respuestaG = ModeloCentroCostos::mdlActualizarIngresosB($datosM);
                    var_dump($respuestaG);

                    # Mostramos una alerta suave
                    echo '<script>
                        swal({
                            type: "success",
                            title: "Felicitaciones",
                            text: "¡El ingreso fue editado con éxito!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result)=>{
                            if(result.value){
                                window.location="ingresos-caja";}
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
                                    window.location="ingresos-caja";}
                            });
                        </script>';
        
                }

            }           

        }

    }    

    /* 
    *ANULAR GASTO
    */
	static public function ctrAnularIngreso(){

        if(isset($_GET["idIngreso"])){

            $id = $_GET["idIngreso"];
            #var_dump($id);

            $gasto = ModeloCentroCostos::mdlMostrarIngresosCajaId($id);
            #var_dump($gasto["fecha"]);

            $fechaIngreso = $gasto["fecha"];
            $mesIngreso = date("m", strtotime($fechaIngreso));
            #var_dump((int)$mesIngreso);

            $saldos = ModeloMaestras::mdlTraerSaldos((int)$mesIngreso);
            #var_dump($saldos["estado"]); 

            if($saldos["estado"] == "CER"){

                # Mostramos una alerta suave
                echo '<script>
                    swal({
                        type: "error",
                        title: "Error",
                        text: "¡No es posible eliminar gastos en un mes cerrado!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then((result)=>{
                        if(result.value){
                            window.location="gastos-caja";}
                    });
                </script>';

            }else{

                #traemos la fecha y la pc
                date_default_timezone_set('America/Lima');
                $fecha = new DateTime();
                $PcReg= gethostbyaddr($_SERVER['REMOTE_ADDR']);                

                $datos = array( "id"        =>  $id, 
                                "fecanu"    =>  $fecha->format("Y-m-d H:i:s"),
                                "usuanu"	=>  $_SESSION["nombre"],
                                "pcanu" 	=>  $PcReg);
                #var_dump($datos);

                $respuesta = ModeloCentroCostos::mdlAnularIngresosCaja($datos);
                #var_dump($respuesta);     
                
                if($respuesta == "ok"){
                    
                    $fecha = $gasto["fecha"];
                    $ingreso = $gasto["total"];

                    $datosM = array("fecha"     => $fecha,
                                    "ingreso"    => $ingreso);

                    #var_dump($datosM);
                    ModeloCentroCostos::mdlActualizarIngresosC($datosM);
                    #var_dump($respuestaG);
                    
                    echo'<script>

                    swal({
                        type: "success",
                        title: "El ingreso ha sido anulado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        }).then(function(result){
                                    if (result.value) {

                                    window.location = "ingresos-caja";

                                    }
                                })

                    </script>';

                }                

            }

        }

    }     

}