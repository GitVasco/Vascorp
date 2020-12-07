<?php

class ControladorVendedores{

	/*=============================================
	CREAR TIPO DE PAGO
	=============================================*/

	static public function ctrCrearVendedor(){

		if(isset($_POST["nuevaDescripcion"])){

				$tabla="vendedorjf";
			   	$datos = array("codigo"=>$_POST["nuevoCodigo"],
							   "nombre"=>$_POST["nuevaDescripcion"]);

			   	$respuesta = ModeloVendedores::mdlIngresarVendedor($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El vendedor ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "vendedor";

									}
								})

					</script>';

				}

			

		}

    }
    

	/*=============================================
	MOSTRAR TIPO DE PAGO
	=============================================*/

	static public function ctrMostrarVendedores($item,$valor){
		$tabla="vendedorjf";
		$respuesta = ModeloVendedores::mdlMostrarVendedores($tabla,$item,$valor);

		return $respuesta;

    }
    
	/*=============================================
	EDITAR TIPO DE PAGO
	=============================================*/

	static public function ctrEditarVendedor(){

		if(isset($_POST["editarDescripcion"])){

				$tabla="vendedorjf";
				   $datos = array("id"=>$_POST["idVendedor"],
				   				"codigo"=> $_POST["editarCodigo"],
                               "nombre"=>$_POST["editarDescripcion"]);

			   	$respuesta = ModeloVendedores::mdlEditarVendedor($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El vendedor ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "vendedor";

									}
								})

					</script>';


			}
		}

    }
    
	/*=============================================
	ELIMINAR TIPO DE PAGO
	=============================================*/

	static public function ctrEliminarVendedor(){

		if(isset($_GET["idVendedor"])){

			$datos = $_GET["idVendedor"];
			$tabla="vendedorjf";
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$vendedor=ControladorVendedores::ctrMostrarVendedores("id",$datos);
			$usuario= $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se elimino un vendedor';
			$descripcion   = 'El usuario '.$usuario.' elimino el vendedor '.$vendedor["codigo"].' - '.$vendedor["nombre"];
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
			
			$respuesta = ModeloVendedores::mdlEliminarVendedor($tabla,$datos);
			if($respuesta == "ok"){
				
				
				echo'<script>

				swal({
					  type: "success",
					  title: "El vendedor ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "vendedor";

								}
							})

				</script>';

			}		

		}

	}    

}
