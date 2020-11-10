<?php

class ControladorAgencias{

	/*=============================================
	CREAR COLORES
	=============================================*/

	static public function ctrCrearAgencia(){

		if(isset($_POST["nuevaDescripcion"])){

				$tabla="agenciasjf";
			   	$datos = array("ruc"=>$_POST["nuevoRUC"],
							   "nombre"=>$_POST["nuevaDescripcion"],
							   "direccion"=>$_POST["nuevaDireccion"],
							   "ubigeo"=>$_POST["nuevoUbigeo"],);

			   	$respuesta = ModeloAgencias::mdlIngresarAgencia($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La agencia ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "agencias";

									}
								})

					</script>';

				}

			

		}

    }
    

	/*=============================================
	MOSTRAR AGENCIAS
	=============================================*/

	static public function ctrMostrarAgencias($item,$valor){
		$tabla="agenciasjf";
		$respuesta = ModeloAgencias::mdlMostrarAgencias($tabla,$item,$valor);

		return $respuesta;

    }
    
	/*=============================================
	EDITAR AGENCIA
	=============================================*/

	static public function ctrEditarAgencia(){

		if(isset($_POST["editarColor"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarColor"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarCodigo"])){

			   	$datos = array("id"=>$_POST["idColor"],
                               "color"=>$_POST["editarColor"],
					           "codigo"=>$_POST["editarCodigo"]);

			   	$respuesta = ModeloColores::mdlEditarColor($datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El color ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "colores";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El color no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "agencias";

							}
						})

			  	</script>';



			}

		}

    }
    
	/*=============================================
	ELIMINAR AGENCIA
	=============================================*/

	static public function ctrEliminarAgencia(){

		if(isset($_GET["idAgencia"])){

			$datos = $_GET["idAgencia"];
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$agencia=ControladorAgencias::ctrMostrarAgencias($datos);
			$usuario= $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se elimino una agencia';
			$descripcion   = 'El usuario '.$usuario.' elimino la agencia '.$agencia["cod_color"].' - '.$agencia["nom_color"];
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
			$respuesta = ModeloAgencias::mdlEliminarAgencia($datos);
			if($respuesta == "ok"){
				
				
				echo'<script>

				swal({
					  type: "success",
					  title: "La agencia ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "agencias";

								}
							})

				</script>';

			}		

		}

	}    

}
