<?php

class ControladorProcedimientos{

	/*=============================================
	CREAR SUBLIMADO
	=============================================*/

	static public function ctrCrearSublimado(){

		if(isset($_POST["nuevoModeloSublimado"])){

				$tabla="sublimado_jf";
				$inicio = new DateTime($_POST["nuevaFechaInicio"]);
				$fin = new DateTime($_POST["nuevaFechaFin"]);
				$tiempoUtilizado = date_diff($fin,$inicio);
			   	$datos = array("modelo"=>$_POST["nuevoModeloSublimado"],
							   "color_modelo"=>$_POST["nuevoColorModelo"],
							   "cantidad"=>$_POST["nuevaCantidad"],
							   "materia_prima"=>$_POST["nuevaMateriaSublimado"],
							   "fecha_inicio"=>$_POST["nuevaFechaInicio"],
							   "fecha_fin"=>$_POST["nuevaFechaFin"],
							   "tiempo_utilizado"=>$tiempoUtilizado->format("%i"),
							   "cod_corte"=>$_POST["nuevoCorteSublimado"],
							   "usuario"=>$_POST["nuevoUsuario"]);


			   	$respuesta = ModeloProcedimientos::mdlIngresarSublimado($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El sublimado ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "sublimados";

									}
								})

					</script>';

				}

			

		}

    }
    

	/*=============================================
	MOSTRAR SUBLIMADOS
	=============================================*/

	static public function ctrMostrarSublimados($item,$valor){
		$tabla="sublimado_jf";
		$respuesta = ModeloProcedimientos::mdlMostrarSublimados($tabla,$item,$valor);

		return $respuesta;

    }
    
    /*=============================================
	MOSTRAR RANGO DE FECHAS SUBLIMADOS
	=============================================*/

	static public function ctrRangoFechasSublimados($fechaInicial,$fechaFinal){
		$tabla="sublimado_jf";
		$respuesta = ModeloProcedimientos::mdlRangoFechasSublimados($tabla,$fechaInicial,$fechaFinal);

		return $respuesta;

    }
	/*=============================================
	EDITAR SUBLIMADO
	=============================================*/

	static public function ctrEditarSublimado(){

		if(isset($_POST["editarDescripcion"])){

				$tabla="sublimado_jf";
				$datos = array("id"=>$_POST["idSublimado"],
							   "modelo"=>$_POST["nuevoModeloSublimado"],
							   "color_modelo"=>$_POST["nuevoColorModelo"],
							   "cantidad"=>$_POST["nuevaCantidad"],
							   "materia_prima"=>$_POST["nuevaMateriaSublimado"],
							   "fecha_inicio"=>$_POST["nuevaFechaInicio"],
							   "fecha_fin"=>$_POST["nuevaFechaFin"],
							   "tiempo_utilizado"=>$_POST["nuevoTiempoU"],
							   "cod_corte"=>$_POST["nuevoCorteSublimado"],
							   "usuario"=>$_POST["nuevoUsuario"]);

			   	$respuesta = ModeloProcedimientos::mdlEditarSublimado($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El sublimado ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "sublimados";

									}
								})

					</script>';


			}
		}

    }
    
	/*=============================================
	ELIMINAR TIPO DE PAGO
	=============================================*/

	static public function ctrEliminarSublimado(){

		if(isset($_GET["idSublimado"])){

			$datos = $_GET["idSublimado"];
			$tabla="sublimado_jf";
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$sublimados=ControladorProcedimientos::ctrMostrarSublimados("id",$datos);
			$usuario= $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se elimino un sublimado';
			$descripcion   = 'El usuario '.$usuario.' elimino el sublimado '.$sublimados["modelo"].' - '.$sublimados["color_modelo"];
			$de = 'From: notificacionesvascorp@gmail.com';
			if($_SESSION["correo"] == 1){
				mail($para, $asunto, $descripcion, $de);
			}
			if($_SESSION["datos"] == 1){
				$datos2= array( "usuario" => $usuario,
								"concepto" => $descripcion,
								"fecha" => $fecha->format("Y-m-d H:i:s"));
				$auditoria=ModeloUsuarios::mdlIngresarAuditoria("auditoriajf",$datos2);
			}
			
			$respuesta = ModeloProcedimientos::mdlEliminarSublimado($tabla,$datos);
			if($respuesta == "ok"){
				
				
				echo'<script>

				swal({
					  type: "success",
					  title: "El sublimado ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "sublimados";

								}
							})

				</script>';

			}		

		}

	}    

}
