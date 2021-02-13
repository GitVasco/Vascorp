<?php
//session_start();
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
    * MOSTRAR DATOS DE TALLERES GENERADOS GENERAL
    */
    static public function ctrMostrarTalleresGenerados($articuloTaller){

        $respuesta = ModeloTalleres::mdlMostrarTalleresGenerados($articuloTaller);

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
    * MOSTRAR DATOS DE TALLERES GENERAL
    */
    static public function ctrMostrarTallerCabecera($item,$valor){

        $tabla="entaller_cabjf";
        $respuesta = ModeloTalleres::mdlMostrarTallerCabecera($tabla,$item,$valor);

        return $respuesta;

    }

    /*
    * MOSTRAR DATOS DE TALLERES TERMINADO GENERAL
    */
    static public function ctrActualizarTallerT($valor1,$valor2){

        $respuesta = ModeloTalleres::mdlActualizarTallerT($valor1, $valor2);

        return $respuesta;

    }

    /* 
    * ACTUALIZAR A EN PROCESO
    */
    static public function ctrProceso(){

        if(isset($_POST["codigoBarra"])){

            $cobar = $_POST["codigoBarra"];

            $validar = ModeloTalleres::mdlMostrarTalleresG($cobar);
            //var_dump($validar);
            //var_dump("fecha_proceso", $validar["fecha_proceso"]);

            if($validar["fecha_proceso"] == null){

                # Actualizamos ultima_compra en la tabla Clientes
                date_default_timezone_set('America/Lima');

                //$fecha = "2021-02-12";
                $fecha = date('Y-m-d G:i:s');
                //var_dump($fecha);

                $codigo = $_POST["codigoBarra"];
                $trabajador = $_POST["cod_tra"];

                $respuesta = ModeloTalleres::mdlProceso($fecha,$codigo,$trabajador);
                //var_dump($respuesta);

                $respuesta2 = ModeloTalleres::mdlTerminado($fecha,$codigo,$trabajador);

                if($respuesta == "ok"){

                echo'<script>

                    window.location = "marcar-taller";

                </script>';


                }
                

            }else{

                # Actualizamos ultima_compra en la tabla Clientes
                date_default_timezone_set('America/Lima');

                //$fecha = "2021-02-12";
                $fecha = date('Y-m-d G:i:s');
                //var_dump($fecha);

                $codigo = $_POST["codigoBarra"];
                $trabajador = $_POST["cod_tra"];

                $respuesta = ModeloTalleres::mdlTerminado($fecha,$codigo,$trabajador);

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
            $datos =array( "codigo"=>$_POST["codigoBarra"],
                            "trabajador"=>$_POST["cod_tra"],
                            "fecha_proceso"=>$_POST["editarFechaProceso"],
                            "fecha_terminado"=>$_POST["editarFechaTerminado"]);

            $respuesta = ModeloTalleres::mdlAsignarTrabajador($datos);
            // var_dump($respuesta);

            if($respuesta == "ok"){

                echo'<script>
                    swal({
						  type: "success",
						  title: "El trabajador y fecha ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "en-tallert";

									}
								})

					</script>';

            }

		}

    }    
    
    /*=============================================
	EDITAR Cantidad
	=============================================*/

	static public function ctrEditarCantidad(){

		if(isset($_POST["editarCantidad2"])){
                $dividir=substr($_POST["editarBarra"],-1);
                if($dividir == 'A'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."B";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == 'B'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."C";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == 'C'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."D";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == 'D'){

                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."E";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);

                }else{
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperacion"]."A";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
                }
                
                
				if($respuesta == "ok" ){
                    $ultimo = $_POST["editarBarra"];
                    $valor=$_POST["editarArticulo"];
                    $rpt_articulo=ModeloArticulos::mdlMostrarArticulos($valor);
                    $modelo = $rpt_articulo["modelo"];
                    $nombre = $rpt_articulo["nombre"];
                    $color = $rpt_articulo["color"];
                    $talla = $rpt_articulo["talla"];
                    $cantidad = $_POST["editarCantidad2"];
                    $cod_ope = $_POST["editarCodOperacion"];
                    $tablaop="operacionesjf";
                    $itemop="codigo";
                    $rpt_operacion=ModeloOperaciones::mdlMostrarOperaciones($tablaop,$itemop,$cod_ope);
                    $nom_ope = $rpt_operacion["nombre"];

                    $ultimo2 = $codigoBarraNuevo;

                    echo'<script>
                    
                    window.open("vistas/reportes_ticket/produccion_ticket_dividir.php?ultimo='.$ultimo.'&modelo='.$modelo.'&nombre='.$nombre.'&color='.$color.'&talla='.$talla.'&cant_taller='.$cantidad.'&cod_operacion='.$cod_ope.'&nom_operacion='.$nom_ope.'&ultimo2='.$ultimo2.'&cant_taller2='.$cantidad2.'","_blank");
                    </script>';
					echo'<script>

					swal({
						  type: "success",
						  title: "La cantidad ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "en-taller";

									}
								})

					</script>';

				}


		}

    }

    
/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasTalleres($fechaInicial, $fechaFinal){

		$tabla = "entallerjf";

		$respuesta = ModeloTalleres::mdlRangoFechasTalleres($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
    }

    /*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasTalleresOperaciones($modelo){


		$respuesta = ModeloTalleres::mdlRangoFechasTalleresOperaciones($modelo);

		return $respuesta;
		
    }
    

    static public function ctrMes(){

        $respuesta = ModeloTalleres::mdlMes();

        return $respuesta;

    }    
    
    /*
    * MOSTRAR PRODUCCION DE TRUSAS
    */
    static public function ctrMostrarProduccionTrusas($fechaInicial,$fechaFinal){

        $respuesta = ModeloTalleres::mdlMostrarProduccionTrusas($fechaInicial,$fechaFinal);

        return $respuesta;

    }

    /*
    * MOSTRAR PRODUCCION DE BRASIER
    */
    static public function ctrMostrarProduccionBrasier($fechaInicial,$fechaFinal){

        $respuesta = ModeloTalleres::mdlMostrarProduccionBrasier($fechaInicial,$fechaFinal);

        return $respuesta;

    }

    /*
    * MOSTRAR PRODUCCION DE VASCO
    */
    static public function ctrMostrarProduccionVasco($mes){

        $respuesta = ModeloTalleres::mdlMostrarProduccionVasco($mes);

        return $respuesta;

    }    


    /*=============================================
	RANGO FECHAS TERMINADOS
	=============================================*/	

	static public function ctrRangoFechasTalleresTerminados($fechaInicial, $fechaFinal){

		$tabla = "entallerjf";

		$respuesta = ModeloTalleres::mdlRangoFechasTalleresTerminados($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

    
 /*=============================================
	EDITAR Cantidad TERMINADO
	=============================================*/

	static public function ctrEditarCantidadTerminado(){

		if(isset($_POST["editarCantidades"])){
            $dividir=substr($_POST["editarBarra"],-1);
            if($dividir == 'A'){
                $datos = array("codigo" => $_POST["editarCodigo"], 
                        "usuario" => $_POST["usuario"],
                        "articulo" => $_POST["editarArticulo"],
                        "operacion" => $_POST["editarCodOperaciones"],
                        "cantidad" => $_POST["editarCantidades"],
                        "editarBarra" => $_POST["editarBarra"],
                        "trabajador" => $_POST["trabajador"],
                        "fecha_proceso" => $_POST["fecha_proceso"],
                        "fecha_terminado" => $_POST["fecha_terminado"]);

                $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."B";
                $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                $tabla="entallerjf";
                $id=$_POST["editarTaller"];
                $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

            }else if($dividir == 'B'){
                $datos = array("codigo" => $_POST["editarCodigo"], 
                        "usuario" => $_POST["usuario"],
                        "articulo" => $_POST["editarArticulo"],
                        "operacion" => $_POST["editarCodOperaciones"],
                        "cantidad" => $_POST["editarCantidades"],
                        "editarBarra" => $_POST["editarBarra"],
                        "trabajador" => $_POST["trabajador"],
                        "fecha_proceso" => $_POST["fecha_proceso"],
                        "fecha_terminado" => $_POST["fecha_terminado"]);

                $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."C";
                $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                $tabla="entallerjf";
                $id=$_POST["editarTaller"];
                $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }else if($dividir == 'C'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."D";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                } else if($dividir == 'D'){

                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."E";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }else{
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $_POST["fecha_terminado"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo=$_POST["editarCodigo"].$_POST["editarCodOperaciones"]."A";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
                }
                
				if($respuesta == "ok" && $respuesta2=="ok"){
                    $ultimo = $_POST["editarBarra"];
                    $valor=$_POST["editarArticulo"];
                    $rpt_articulo=ModeloArticulos::mdlMostrarArticulos($valor);
                    $modelo = $rpt_articulo["modelo"];
                    $nombre = $rpt_articulo["nombre"];
                    $color = $rpt_articulo["color"];
                    $talla = $rpt_articulo["talla"];
                    $cantidad = $_POST["editarCantidades"];
                    $cod_ope = $_POST["editarCodOperaciones"];
                    $tablaop="operacionesjf";
                    $itemop="codigo";
                    $rpt_operacion=ModeloOperaciones::mdlMostrarOperaciones($tablaop,$itemop,$cod_ope);
                    $nom_ope = $rpt_operacion["nombre"];

                    $ultimo2 = $codigoBarraNuevo;

                    echo'<script>
                    
                    window.open("vistas/reportes_ticket/produccion_ticket_dividir.php?ultimo='.$ultimo.'&modelo='.$modelo.'&nombre='.$nombre.'&color='.$color.'&talla='.$talla.'&cant_taller='.$cantidad.'&cod_operacion='.$cod_ope.'&nom_operacion='.$nom_ope.'&ultimo2='.$ultimo2.'&cant_taller2='.$cantidad2.'","_blank");
                    </script>';
					echo'<script>

					swal({
						  type: "success",
						  title: "La cantidad ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "en-tallert";

									}
								})

					</script>';

				}


		}

    }

    /*=============================================
	EXPORTAR TICKET POR CODIGO UNICO TALLER CABECERA
	=============================================*/

	static public function ctrExportarArticulo(){

		if(isset($_POST["nuevoCodigo"])){

            $cod = $_POST["nuevoCodigo"];

            echo'<script>
            
            window.open("vistas/reportes_ticket/produccion_ticket.php?codigo='.$cod.'" ,"_blank");
                   
            </script>';

            echo'<script>

            swal({
                  type: "success",
                  title: "Se exporto ticket de articulo a taller correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                            if (result.value) {

                            window.location = "en-taller";

                            }
                        })

            </script>';
		}

    }

    /*=============================================
	ELIMINAR TALLER POR CODIGO UNICO TALLER CABECERA
	=============================================*/

	static public function ctrEliminarArticulo(){

		if(isset($_POST["nuevoCodigo2"])){
            $tabla="entallerjf";
            $cod = $_POST["nuevoCodigo2"];

            $respuesta1=ModeloTalleres::mdlEliminarTallerDetalle($tabla,$cod);
            $tabla2="entaller_cabjf";
            //Traemos la cabecera taller
            $cabeceraTaller=ControladorTalleres::ctrMostrarTallerCabecera("id",$cod);

            /* 
            * Actualizamos la cantidad que quedo en taller y regresa al corte en el codigo unico eliminado
            */
            $articulo  = $cabeceraTaller["articulo"];
            $cantidad =  $cabeceraTaller["cantidad"];

            $respuesta=ModeloArticulos::mdlActualizarTallerEliminado($articulo,$cantidad);


            $respuesta2=ModeloTalleres::mdlEliminarTaller($tabla2,$cod);
            if($respuesta2 == "ok"){
                echo'<script>

                swal({
                    type: "success",
                    title: "Se elimino el ticket de taller correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                                if (result.value) {

                                window.location = "en-taller";

                                }
                            })
                </script>';
            }
		}

    }

    /*=============================================
	EDITAR Cantidad Operacion
	=============================================*/

	static public function ctrEditarCantidadOperacion(){

		if(isset($_POST["editarCantidad2"])){
                $dividir=substr($_POST["editarBarra"],-1);
                if($dividir == 'A'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo=$_POST["editarBarra"]."B";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }else if($dividir == 'B'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo=$_POST["editarBarra"]."C";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperacion"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }else if($dividir == 'C'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo=$_POST["editarBarra"]."D";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                } else if($dividir == 'D'){

                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo=$_POST["editarBarra"]."E";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);

                }else{
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad2"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidad"]-$_POST["editarCantidad2"];
                    $codigoBarraNuevo = $_POST["editarBarra"]."A";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
                }
                
                
				if($respuesta == "ok" ){
                    $ultimo = $_POST["editarBarra"];
                    $valor=$_POST["editarArticulo"];
                    $rpt_articulo=ModeloArticulos::mdlMostrarArticulos($valor);
                    $modelo = $rpt_articulo["modelo"];
                    $nombre = $rpt_articulo["nombre"];
                    $color = $rpt_articulo["color"];
                    $talla = $rpt_articulo["talla"];
                    $cantidad = $_POST["editarCantidad2"];
                    $cod_ope = $_POST["editarCodOperacion"];
                    $tablaop="operacionesjf";
                    $itemop="codigo";
                    $rpt_operacion=ModeloOperaciones::mdlMostrarOperaciones($tablaop,$itemop,$cod_ope);
                    $nom_ope = $rpt_operacion["nombre"];

                    $ultimo2 = $codigoBarraNuevo;

                    echo'<script>
                    
                    window.open("vistas/reportes_ticket/produccion_ticket_dividir.php?ultimo='.$ultimo.'&modelo='.$modelo.'&nombre='.$nombre.'&color='.$color.'&talla='.$talla.'&cant_taller='.$cantidad.'&cod_operacion='.$cod_ope.'&nom_operacion='.$nom_ope.'&ultimo2='.$ultimo2.'&cant_taller2='.$cantidad2.'","_blank");
                    </script>';
					echo'<script>

					swal({
						  type: "success",
						  title: "La cantidad ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "operacion-taller";

									}
								})

					</script>';

				}


		}

    }

    /*=============================================
	EDITAR Cantidad
	=============================================*/

	static public function ctrEditarCantidadGenerado(){

		if(isset($_POST["editarCantidades"])){
                $dividir=substr($_POST["editarBarra"],-1);
                if($dividir == 'A'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."B";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == 'B'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."C";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                                "usuario" => $_POST["usuario"],
                                "articulo" => $_POST["editarArticulo"],
                                "operacion" => $_POST["editarCodOperaciones"],
                                "cantidad" => $cantidad2,
                                "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == 'C'){
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."D";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == 'D'){

                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."E";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == 'E'){

                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."F";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == 'F'){

                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."G";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == 'G'){

                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."H";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == 'H'){

                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."I";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);

                }elseif($dividir == 'I'){

                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."J";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);

                }else{
                    $datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"]);

                    $cantidad2=$_POST["cantidades"]-$_POST["editarCantidades"];
                    $codigoBarraNuevo = $_POST["editarCodigo"].$_POST["editarCodOperaciones"]."A";
                    $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $cantidad2,
                            "editarBarra" => $codigoBarraNuevo);
                    $tabla="entallerjf";
                    $id=$_POST["editarTaller"];
                    $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                    $respuesta = ModeloTalleres::mdlIngresarTaller($datos2);
                }
                
                
				if($respuesta == "ok" ){
                    $ultimo = $_POST["editarBarra"];
                    $valor=$_POST["editarArticulo"];
                    $rpt_articulo=ModeloArticulos::mdlMostrarArticulos($valor);
                    $modelo = $rpt_articulo["modelo"];
                    $nombre = $rpt_articulo["nombre"];
                    $color = $rpt_articulo["color"];
                    $talla = $rpt_articulo["talla"];
                    $cantidad = $_POST["editarCantidades"];
                    $cod_ope = $_POST["editarCodOperaciones"];
                    $tablaop="operacionesjf";
                    $itemop="codigo";
                    $rpt_operacion=ModeloOperaciones::mdlMostrarOperaciones($tablaop,$itemop,$cod_ope);
                    $nom_ope = $rpt_operacion["nombre"];

                    $ultimo2 = $codigoBarraNuevo;

                    echo'<script>
                    
                    window.open("vistas/reportes_ticket/produccion_ticket_dividir.php?ultimo='.$ultimo.'&modelo='.$modelo.'&nombre='.$nombre.'&color='.$color.'&talla='.$talla.'&cant_taller='.$cantidad.'&cod_operacion='.$cod_ope.'&nom_operacion='.$nom_ope.'&ultimo2='.$ultimo2.'&cant_taller2='.$cantidad2.'","_blank");
                    </script>';
					echo'<script>

					swal({
						  type: "success",
						  title: "La cantidad ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "en-tallerp";

									}
								})

					</script>';

				}


		}

    }

    static public function ctrCrearTicket(){

		if(isset($_POST["verCantidad"])){
            $datosCab=array("articulo" => $_POST["verArti"], 
                             "usuario" => $_POST["verUser"],
                             "cantidad" => $_POST["verCantidad"]);
            $respuestaCab=ModeloCortes::mdlMandarTallerCab($datosCab);
            
            

            $ultId=ModeloCortes::mdlUltCodigo();

            $datos = array("codigo" => $ultId["ult_codigo"], 
                    "usuario" => $_POST["verUser"],
                    "articulo" => $_POST["verArti"],
                    "operacion" => $_POST["verCodOP"],
                    "cantidad" => $_POST["verCantidad"],
                    "editarBarra" => $ultId["ult_codigo"].$_POST["verCodOP"]);

            $respuesta=ModeloTalleres::mdlIngresarTaller($datos);
            
            if($respuesta == "ok"){
                $ultimo = $ultId["ult_codigo"].$_POST["verCodOP"];
                $valor=$_POST["verArti"];
                $rpt_articulo=ModeloArticulos::mdlMostrarArticulos($valor);
                $modelo = $rpt_articulo["modelo"];
                $nombre = $rpt_articulo["nombre"];
                $color = $rpt_articulo["color"];
                $talla = $rpt_articulo["talla"];
                $cantidad = $_POST["verCantidad"];
                $cod_ope = $_POST["verCodOP"];
                $tablaop="operacionesjf";
                $itemop="codigo";
                $rpt_operacion=ModeloOperaciones::mdlMostrarOperaciones($tablaop,$itemop,$cod_ope);
                $nom_ope = $rpt_operacion["nombre"];

                echo '<script>

                window.open("vistas/reportes_ticket/produccion_ticket_detalle.php?ultimo='.$ultimo.'&modelo='.$modelo.'&nombre='.$nombre.'&color='.$color.'&talla='.$talla.'&cant_taller='.$cantidad.'&cod_operacion='.$cod_ope.'&nom_operacion='.$nom_ope.'","_blank");
                </script>';

                echo'<script>
                    swal({
						  type: "success",
						  title: "El ticket ha sido creado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "en-taller";

									}
								})

					</script>';

            }

        }
    }

    static public function ctrCrearTicketOriginal(){

        if(isset($_POST["ticketArticulo"])){

            /* 
            * registramos en la tabla taller cabecera para el código
            */
            $datosCab = array( "usuario" => $_POST["ticketUser"],
                            "articulo" => $_POST["ticketArticulo"],
                            "cantidad" => $_POST["ticketCantidad"]);

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
                $datos = array("codigo" => $ult_codigo["ult_codigo"], 
                    "usuario" => $_POST["ticketUser"],
                    "articulo" => $_POST["ticketArticulo"],
                    "operacion" => $_POST["ticketOperacion"],
                    "cantidad" => $_POST["ticketCantidad"],
                    "editarBarra" => $ult_codigo["ult_codigo"].$_POST["ticketOperacion"]);
                

                $respuesta=ModeloTalleres::mdlIngresarTaller($datos);

                //var_dump($respuesta);
                if($respuesta == "ok"){

                    $ultimo = $ult_codigo["ult_codigo"].$_POST["ticketOperacion"];
                    $valor=$_POST["ticketArticulo"];
                    $rpt_articulo=ModeloArticulos::mdlMostrarArticulos($valor);
                    $modelo = $rpt_articulo["modelo"];
                    $nombre = $rpt_articulo["nombre"];
                    $color = $rpt_articulo["color"];
                    $talla = $rpt_articulo["talla"];
                    $cantidad = $_POST["ticketCantidad"];
                    $cod_ope = $_POST["ticketOperacion"];
                    $tablaop="operacionesjf";
                    $itemop="codigo";
                    $rpt_operacion=ModeloOperaciones::mdlMostrarOperaciones($tablaop,$itemop,$cod_ope);
                    $nom_ope = $rpt_operacion["nombre"];
    
                    echo '<script>
    
                    window.open("vistas/reportes_ticket/produccion_ticket_detalle.php?ultimo='.$ultimo.'&modelo='.$modelo.'&nombre='.$nombre.'&color='.$color.'&talla='.$talla.'&cant_taller='.$cantidad.'&cod_operacion='.$cod_ope.'&nom_operacion='.$nom_ope.'","_blank");
                    </script>';
                    echo'<script>

                    swal({
                          type: "success",
                          title: "Se mando a taller correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                            if (result.value) {

                            window.location = "en-taller";

                            }
                        })

                    </script>';

                }

            }

        }

    }
}