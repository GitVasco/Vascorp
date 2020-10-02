<?php

class ControladorIngresos{

    /* 
    * MOSTRAR DATOS DE LAS ORDENES DE CORTE
    */
    static public function ctrMostrarIngresos($item, $valor){

        $tabla = "movimientos_cabecerajf";

        $respuesta = ModeloIngresos::mdlMostarIngresos($tabla, $item, $valor);

        return $respuesta;

    }

    /* 
    * MOSTRAR DATOS DE LAS ORDENES DE CORTE
    */
    static public function ctrMostrarDetallesIngresos($item, $valor){

        $tabla = "movimientosjf";

        $respuesta = ModeloIngresos::mdlMostarDetallesIngresos($tabla, $item, $valor);

        return $respuesta;

    }
    /* 
    * CREAR INGRESO
    */
    static public function ctrCrearIngreso(){

        /* 
        todo: Verificamos que traiga datos
        */
        if( isset($_POST["nuevoTalleres"]) &&
            isset($_POST["idUsuario"])){

                #var_dump("nuevaOrdenCorte", $_POST["nuevaOrdenCorte"]);

                if($_POST["listaArticulosIngreso"] == ""){

                    /* 
                    ? Mostramos una alerta suave si viene vacia
                    */
                    echo '<script>
                            swal({
                                type: "error",
                                title: "Error",
                                text: "¡No se seleccionó ningún artículo. Por favor, intenteló de nuevo!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then((result)=>{
                                if(result.value){
                                    window.location="crear-ingresos";}
                            });
                        </script>';

                }else{

                    /* 
                    ? Actualizamos la cantidad de la orden de corte
                    */

                    $listaArticulos = json_decode($_POST["listaArticulosIngreso"], true);

                    #var_dump("listaArticulos", $listaArticulos);

                    foreach($listaArticulos as $value){

                        $tabla = "articulojf";

                        $valor = $value["articulo"];

                        $item1 = "taller";
                        $valor1 = $value["taller"];

                        ModeloArticulos::mdlActualizarUnDato($tabla, $item1, $valor1, $valor);

                    }

                    /* 
                    * GUARDAR LA ORDEN DE CORTE
                    */
                    $fecha=new DateTime();
                    $datos = array( "tipo"=>"E20",
                                    "usuario"=>$_POST["idUsuario"],
                                    "taller"=>$_POST["nuevoTalleres"],
                                    "documento"=>$_POST["nuevoCodigo"],
                                    "total"=>$_POST["totalTaller"],
                                    "fecha"=>$fecha->format("Y-m-d"),
                                    "almacen" => "01");

                    #var_dump("datos", $datos);
                    
                    $respuesta = ModeloIngresos::mdlGuardarIngreso("movimientos_cabecerajf", $datos);

                    if($respuesta == "ok"){


                        foreach($listaArticulos as $key=>$value){

                            $datosD = array("tipo"=>"E20",
                                            "documento"=>$_POST["nuevoCodigo"],
                                            "taller"=>$_POST["nuevoTalleres"],
                                            "fecha"=>$fecha->format("Y-m-d"),
                                            "articulo"=>$value["articulo"],
                                            "cantidad"=>$value["cantidad"],
                                            "almacen"=>"01");

                            #var_dump("datosD", $datosD);

                            ModeloIngresos::mdlGuardarDetalleIngreso("movimientosjf", $datosD);

                        }

                        # Mostramos una alerta suave
                        echo '<script>
                                swal({
                                    type: "success",
                                    title: "Felicitaciones",
                                    text: "¡La información fue registrada con éxito!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                }).then((result)=>{
                                    if(result.value){
                                        window.location="ingresos";}
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
									window.location="crear-ingresos";}
							});
						</script>';

                    }



                }

        }


    }

    /* 
    * CREAR INGRESO
    */
    static public function ctrCrearSegunda(){

        /* 
        todo: Verificamos que traiga datos
        */
        if( isset($_POST["nuevoTalleres"]) &&
            isset($_POST["idUsuario"])){

                #var_dump("nuevaOrdenCorte", $_POST["nuevaOrdenCorte"]);

                if($_POST["listaArticulosIngreso"] == ""){

                    /* 
                    ? Mostramos una alerta suave si viene vacia
                    */
                    echo '<script>
                            swal({
                                type: "error",
                                title: "Error",
                                text: "¡No se seleccionó ningún artículo. Por favor, intenteló de nuevo!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then((result)=>{
                                if(result.value){
                                    window.location="crear-segunda";}
                            });
                        </script>';

                }else{

                    /* 
                    ? Actualizamos la cantidad de la orden de corte
                    */

                    $listaArticulos = json_decode($_POST["listaArticulosIngreso"], true);

                    #var_dump("listaArticulos", $listaArticulos);

                    foreach($listaArticulos as $value){

                        $tabla = "articulojf";

                        $valor = $value["articulo"];

                        $item1 = "taller";
                        $valor1 = $value["taller"];

                        ModeloArticulos::mdlActualizarUnDato($tabla, $item1, $valor1, $valor);

                    }

                    /* 
                    * GUARDAR LA ORDEN DE CORTE
                    */
                    $fecha=new DateTime();
                    $datos = array( "tipo"=>"E20",
                                    "usuario"=>$_POST["idUsuario"],
                                    "taller"=>$_POST["nuevoTalleres"],
                                    "documento"=>$_POST["nuevoCodigo"],
                                    "total"=>$_POST["totalTaller"],
                                    "fecha"=>$fecha->format("Y-m-d"),
                                    "almacen" => "02",
                                    "trabajador"=>$_POST["nuevoTrabajadores"]);

                    #var_dump("datos", $datos);
                    
                    $respuesta = ModeloIngresos::mdlGuardarSegunda("movimientos_cabecerajf", $datos);

                    if($respuesta == "ok"){


                        foreach($listaArticulos as $key=>$value){

                            $datosD = array("tipo"=>"E20",
                                            "documento"=>$_POST["nuevoCodigo"],
                                            "taller"=>$_POST["nuevoTalleres"],
                                            "fecha"=>$fecha->format("Y-m-d"),
                                            "articulo"=>$value["articulo"],
                                            "cliente"=>$_POST["nuevoTrabajadores"],
                                            "cantidad"=>$value["cantidad"],
                                            "almacen"=>"02");

                            #var_dump("datosD", $datosD);

                            ModeloIngresos::mdlGuardarDetalleSegunda("movimientosjf", $datosD);

                        }

                        # Mostramos una alerta suave
                        echo '<script>
                                swal({
                                    type: "success",
                                    title: "Felicitaciones",
                                    text: "¡La información fue registrada con éxito!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                }).then((result)=>{
                                    if(result.value){
                                        window.location="ingresos";}
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
									window.location="crear-segunda";}
							});
						</script>';

                    }



                }

        }


    }

    /* 
    * Editar Orden de Corte
    */
    static public function ctrEditarIngreso(){

        if(isset($_POST["idUsuario"]) && isset($_POST["listaArticulosIngreso"])){

            #var_dump($_POST["editarCodigo"], $_POST["idUsuario"],$_POST["listaArticulosOC"]);

            if($_POST["listaArticulosIngreso"] == ""){

				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡No se cambio ninguna materia prima. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="index.php?ruta=editar-ingreso";}
						});
					</script>';              

            }else{

                /* 
                todo: Traemos los datos del detalle de Orden de Corte
                */
                $detaOC = ModeloIngresos::mdlMostarDetallesIngresos("movimientosjf", "documento", $_POST["editarCodigo"]);
                #var_dump("detaOC", $detaOC);

                /* 
                todo: Cabiamos los codigos de al lista por los codigos de articulos
                */
                foreach($detaOC as $key=>$value){

                    $infoArt = controladorArticulos::ctrMostrarArticulos($value["articulo"]);
                    $detaOC[$key]["articulo"]=$infoArt["articulo"];
                    #var_dump("detaOC", $detaOC[$key]["articulo"]);

                }

                if($_POST["listaArticulosIngreso"] == ""){

                    $listaArticulosOC = $detaOC;
                    $validarCambio = false;

                }else{

                    $listaArticulosOC = json_decode($_POST["listaArticulosIngreso"], true);
                    $validarCambio = true;

                }

                if($validarCambio){

                    /* 
                    todo: Actualizamos en articulos las ord_Corte
                    */
                    foreach($listaArticulosOC as $key=>$value){

                        $item1 = "taller";
                        $valor1 = $value["taller"];
                        $valor2 = $value["articulo"];

                        ModeloArticulos::mdlActualizarUnDato("articulojf", $item1, $valor1, $valor2);

                    }

                }
                $fecha=new DateTime();
                /* 
                todo: Editamos los cambios de la cabecera Orden de Corte
                */
                $datos = array( "documento"=>$_POST["editarCodigo"],
                                "taller"=>$_POST["editarTalleres"],
                                "usuario"=>$_POST["idUsuario"],
                                "total"=>$_POST["totalTaller"],
                                "fecha"=>$fecha->format("Y-m-d"));
                #var_dump("datos", $datos);

                $respuesta = ModeloIngresos::mdlEditarIngreso("movimientos_cabecerajf", $datos);

                if($respuesta == "ok"){

                    /* 
                    todo: Editamos los cambios del detalle Ordenes de Corte, primero eliminamos los detalles
                    */

                    $eliminarDato = ModeloIngresos::mdlEliminarDato("movimientosjf", "documento", $_POST["editarCodigo"]);

                    $eliminarDato = "ok";

                    if($eliminarDato == "ok"){

                        foreach($listaArticulosOC as $key=>$value){

                            #var_dump("listaArticulosOC", $listaArticulosOC);

                            $datosD = array("tipo"=>"E20",
                                            "documento"=>$_POST["editarCodigo"],
                                            "taller"=>$_POST["editarTalleres"],
                                            "fecha"=>$fecha->format("Y-m-d"),
                                            "articulo"=>$value["articulo"],
                                            "cantidad"=>$value["cantidad"],
                                            "almacen" => "01");
                            #var_dump("datosD", $datosD);

                            ModeloIngresos::mdlGuardarDetalleIngreso("movimientosjf", $datosD);

                        }

                        # Mostramos una alerta suave
                        echo '<script>
                                swal({
                                    type: "success",
                                    title: "Felicitaciones",
                                    text: "¡La información fue Actualizada con éxito!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                }).then((result)=>{
                                    if(result.value){
                                        window.location="ingresos";}
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
									window.location="ingresos";}
							});
						</script>';

                    }


                }else{

				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡La información presento problemas y no se actualizó adecuadamente. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="ingresos";}
						});
					</script>';

                }                                

            }

        }

    }

    static public function ctrEditarSegunda(){

        if(isset($_POST["idUsuario"]) && isset($_POST["listaArticulosIngreso"])){

            #var_dump($_POST["editarCodigo"], $_POST["idUsuario"],$_POST["listaArticulosOC"]);

            if($_POST["listaArticulosIngreso"] == ""){

				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡No se cambio ninguna materia prima. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="index.php?ruta=editar-ingreso";}
						});
					</script>';              

            }else{

                /* 
                todo: Traemos los datos del detalle de Orden de Corte
                */
                $detaOC = ModeloIngresos::mdlMostarDetallesIngresos("movimientosjf", "documento", $_POST["editarCodigo"]);
                #var_dump("detaOC", $detaOC);

                /* 
                todo: Cabiamos los codigos de al lista por los codigos de articulos
                */
                foreach($detaOC as $key=>$value){

                    $infoArt = controladorArticulos::ctrMostrarArticulos($value["articulo"]);
                    $detaOC[$key]["articulo"]=$infoArt["articulo"];
                    #var_dump("detaOC", $detaOC[$key]["articulo"]);

                }

                if($_POST["listaArticulosIngreso"] == ""){

                    $listaArticulosOC = $detaOC;
                    $validarCambio = false;

                }else{

                    $listaArticulosOC = json_decode($_POST["listaArticulosIngreso"], true);
                    $validarCambio = true;

                }

                if($validarCambio){

                    /* 
                    todo: Actualizamos en articulos las ord_Corte
                    */
                    foreach($listaArticulosOC as $key=>$value){

                        $item1 = "taller";
                        $valor1 = $value["taller"];
                        $valor2 = $value["articulo"];

                        ModeloArticulos::mdlActualizarUnDato("articulojf", $item1, $valor1, $valor2);

                    }

                }
                $fecha=new DateTime();
                /* 
                todo: Editamos los cambios de la cabecera Orden de Corte
                */
                $datos = array( "documento"=>$_POST["editarCodigo"],
                                "taller"=>$_POST["editarTalleres"],
                                "usuario"=>$_POST["idUsuario"],
                                "total"=>$_POST["totalTaller"],
                                "fecha"=>$fecha->format("Y-m-d"),
                                "almacen"=>"02",
                                "trabajador" => $_POST["editarTrabajadores"]);
                #var_dump("datos", $datos);

                $respuesta = ModeloIngresos::mdlEditarIngreso("movimientos_cabecerajf", $datos);

                if($respuesta == "ok"){

                    /* 
                    todo: Editamos los cambios del detalle Ordenes de Corte, primero eliminamos los detalles
                    */

                    $eliminarDato = ModeloIngresos::mdlEliminarDato("movimientosjf", "documento", $_POST["editarCodigo"]);

                    $eliminarDato = "ok";

                    if($eliminarDato == "ok"){

                        foreach($listaArticulosOC as $key=>$value){

                            #var_dump("listaArticulosOC", $listaArticulosOC);

                            $datosD = array("tipo"=>"E20",
                                            "documento"=>$_POST["editarCodigo"],
                                            "taller"=>$_POST["editarTalleres"],
                                            "fecha"=>$fecha->format("Y-m-d"),
                                            "articulo"=>$value["articulo"],
                                            "cliente"=>$_POST["editarTrabajadores"],
                                            "cantidad"=>$value["cantidad"],
                                            "almacen" => "02");
                            #var_dump("datosD", $datosD);

                            ModeloIngresos::mdlGuardarDetalleSegunda("movimientosjf", $datosD);

                        }

                        # Mostramos una alerta suave
                        echo '<script>
                                swal({
                                    type: "success",
                                    title: "Felicitaciones",
                                    text: "¡La información fue Actualizada con éxito!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                }).then((result)=>{
                                    if(result.value){
                                        window.location="ingresos";}
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
									window.location="ingresos";}
							});
						</script>';

                    }


                }else{

				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡La información presento problemas y no se actualizó adecuadamente. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="ingresos";}
						});
					</script>';

                }                                

            }

        }

    }

    /* 
    *Método para eliminar las ordenes de corte
    */
    static public function ctrEliminarIngreso(){
        if(isset($_GET["documento"]) && isset($_GET["idIngreso"]) ){
        $item = "documento";
        $codigo=$_GET["documento"];

        $detaOC = ModeloIngresos::mdlMostarDetallesIngresos("movimientosjf", "documento", $codigo);
        #var_dump("detaOC", $detaOC);

        /* 
        todo: Actualizamos orden de corte en Articulojf
        */
        foreach($detaOC as $key=>$value){

            $valorA = $value["articulo"];
            #var_dump("valorA", $valorA);

            $infoA = ModeloArticulos::mdlMostrarArticulos($valorA);

            $taller = $infoA["taller"] - $value["cantidad"];
            #var_dump("ord_corte", $ord_corte);

            ModeloArticulos::mdlActualizarUnDato("articulojf", "taller", $taller, $value["articulo"]);

        }

        /* 
        todo: Eliminamos la cabecera de Orden de corte
        */
        $tablaOC = "movimientos_cabecerajf";
        $itemOC = "id";
        $valorOC = $_GET["idIngreso"];

        $respuesta = ModeloIngresos::mdlEliminarDato($tablaOC, $itemOC, $valorOC);
        $respuesta= ModeloIngresos::mdlEliminarDato("movimientosjf","documento",$codigo);

        if($respuesta == "ok"){

            /* 
            todo: Eliminamos el detalle de Orden de corte
            */
            echo '<script>
                                swal({
                                    type: "success",
                                    title: "Felicitaciones",
                                    text: "¡La información fue eliminada con éxito!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                }).then((result)=>{
                                    if(result.value){
                                        window.location="ingresos";}
                                });
                            </script>';   
           
        }

        return $respuesta;
        }
    }
    
	
    /*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasIngresos($fechaInicial, $fechaFinal){

		$tabla = "movimientos_cabecerajf";

		$respuesta = ModeloIngresos::mdlRangoFechasIngresos($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
    }
   
}