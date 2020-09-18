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
                $trabajador = $_POST["cod_tra"];

                $respuesta = ModeloTalleres::mdlProceso($fecha,$codigo,$trabajador);

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
    
    /*=============================================
	EDITAR Cantidad
	=============================================*/

	static public function ctrEditarCantidad(){

		if(isset($_POST["editarCantidad"])){

                
				$datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $_POST["editarCantidad"],
                            "editarBarra" => $_POST["editarBarra"]."A");

                $cantidad=$_POST["cantidad"]-$_POST["editarCantidad"];

                $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperacion"],
                            "cantidad" => $cantidad,
                            "editarBarra" => $_POST["editarBarra"]."B");
                $tabla="entallerjf";
                $id=$_POST["editarTaller"];
                $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                $respuesta = ModeloTalleres::mdlIngresarTaller($datos);
                $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
                
				if($respuesta == "ok" && $respuesta2=="ok"){
                    $ultimo = $_POST["editarBarra"]."A";
                    $valor=$_POST["editarArticulo"];
                    $rpt_articulo=ModeloArticulos::mdlMostrarArticulos($valor);
                    $modelo = $rpt_articulo["modelo"];
                    $nombre = $rpt_articulo["nombre"];
                    $color = $rpt_articulo["color"];
                    $talla = $rpt_articulo["talla"];
                    $cantidad = $_POST["editarCantidad"];
                    $cod_ope = $_POST["editarCodOperacion"];
                    $tablaop="operacionesjf";
                    $itemop="codigo";
                    $rpt_operacion=ModeloOperaciones::mdlMostrarOperaciones($tablaop,$itemop,$cod_ope);
                    $nom_ope = $rpt_operacion["nombre"];

                    $ultimo2 = $_POST["editarBarra"]."B";
                    $cantidad2 = $_POST["cantidad"];

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

    

    static public function ctrMes(){

        $respuesta = ModeloTalleres::mdlMes();

        return $respuesta;

    }    
    
    /*
    * MOSTRAR PRODUCCION DE TRUSAS
    */
    static public function ctrMostrarProduccionTrusas($mes){

        $respuesta = ModeloTalleres::mdlMostrarProduccionTrusas($mes);

        return $respuesta;

    }

    /*
    * MOSTRAR PRODUCCION DE BRASIER
    */
    static public function ctrMostrarProduccionBrasier($mes){

        $respuesta = ModeloTalleres::mdlMostrarProduccionBrasier($mes);

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
	EDITAR Cantidad
	=============================================*/

	static public function ctrEditarCantidadTerminado(){

		if(isset($_POST["editarCantidades"])){
                date_default_timezone_set('America/Lima');
                $fecha = new Datetime();
				$datos = array("codigo" => $_POST["editarCodigo"], 
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $_POST["editarCantidades"],
                            "editarBarra" => $_POST["editarBarra"],
                            "trabajador" => $_POST["trabajador"],
                            "fecha_proceso" => $_POST["fecha_proceso"],
                            "fecha_terminado" => $fecha->format("Y-m-d H:i:s"));

                $cantidad=$_POST["cantidades"]-$_POST["editarCantidades"];

                $datos2 = array("codigo" => $_POST["editarCodigo"],
                            "usuario" => $_POST["usuario"],
                            "articulo" => $_POST["editarArticulo"],
                            "operacion" => $_POST["editarCodOperaciones"],
                            "cantidad" => $cantidad,
                            "editarBarra" => $_POST["editarBarra"]."A");
                $tabla="entallerjf";
                $id=$_POST["editarTaller"];
                $eliminar=ModeloTalleres::mdlEliminarTaller($tabla,$id);
                $respuesta = ModeloTalleres::mdlIngresarTallerTerminado($datos);
                $respuesta2 = ModeloTalleres::mdlIngresarTaller($datos2);
                
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

                    $ultimo2 = $_POST["editarBarra"]."A";
                    $cantidad2 = $_POST["cantidad"];

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
}