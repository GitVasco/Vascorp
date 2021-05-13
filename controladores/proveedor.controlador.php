<?php

class ControladorProveedores{

	/*=============================================
	MOSTRAR ULTIMO CODIGO DE PROVEEDOR
	=============================================*/

	static public function ctrMostrarUltimoCodRuc(){
		$respuesta = ModeloProveedores::mdlMostrarUltimoCodRuc();

		return $respuesta;

    }

	/*=============================================
	CREAR PROVEEDOR
	=============================================*/

	static public function ctrCrearProveedor(){

		if(isset($_POST["nuevoRUC"])){

			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$PcReg= gethostbyaddr($_SERVER['REMOTE_ADDR']);


			$tabla="proveedor";
			$datos = array("Cod_Local"=>'01',
							"Cod_Entidad"=>'01',
							"CodRuc"=>$_POST["nuevoCodigoPro"],
							"TipPro"=>$_POST["nuevoTipoProv"],
							"RucPro"=>$_POST["nuevoRUC"],
							"RazPro"=>$_POST["nuevaRazPro"],
							"DirPro"=>$_POST["nuevaDireccion"],
							"UbiPro"=>$_POST["nuevoUbiPro"],
							"TelPro1"=>$_POST["nuevoTlf1"],
							"TelPro2"=>$_POST["nuevoTlf2"],
							"TelPro3"=>$_POST["nuevoTlf3"],
							"FaxPro"=>$_POST["nuevoTlf4"],
							"ConPro"=>$_POST["nuevoContacto"],
							"EmaPro"=>$_POST["nuevoEmail1"],
							"EmaPro2"=>$_POST["nuevoEmail2"],
							"WebPro"=>$_POST["nuevaWeb"],
							"TieEnt"=>$_POST["nuevoTipoEntr"],
							"ForPag"=>$_POST["nuevaFormaPago"],
							"Dia"=>$_POST["nuevoDias"],
							"Banco"=>$_POST["nuevoBanco"],
							"Moneda"=>$_POST["nuevaMoneda"],
							"NroCta"=>$_POST["nuevoNroCuenta"],
							"Banco1"=>$_POST["nuevoBanco1"],
							"Moneda1"=>$_POST["nuevaMoneda1"],
							"NroCta1"=>$_POST["nuevoNroCuenta1"],
							"EstPro"=>'1',
							"Observa"=>$_POST["nuevaObservacion"],
							"FecReg"=>$fecha->format("Y-m-d H:i:s"),
							"PcReg"=>$PcReg,
							"UsuReg"=>$_SESSION["id"]);

							// var_dump($datos);

			   	$respuesta = ModeloProveedores::mdlIngresarProveedor($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El proveedor ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "proveedor";

									}
								})

					</script>';

				}

			

		}

    }
    

	/*=============================================
	MOSTRAR PROVEEDORES
	=============================================*/

	static public function ctrMostrarProveedores($item,$valor){
		$tabla="proveedor";
		$respuesta = ModeloProveedores::mdlMostrarProveedores($tabla,$item,$valor);

		return $respuesta;

    }

	
    
	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/

	static public function ctrEditarProveedor(){

		if(isset($_POST["editarDescripcion"])){

				$tabla="proveedor";
				   $datos = array("id"=>$_POST["idBanco"],
				   				"codigo"=> $_POST["editarCodigo"],
                               "descripcion"=>$_POST["editarDescripcion"]);

			   	$respuesta = ModeloProveedores::mdlEditarProveedor($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El banco ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "proveedor";

									}
								})

					</script>';


			}
		}

    }
    
	/*=============================================
	ELIMINAR TIPO DE PAGO
	=============================================*/

	static public function ctrEliminarProveedor(){

		if(isset($_GET["idProveedor"])){

			$datos = $_GET["idProveedor"];
			$tabla="proveedor";
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$bancos=ControladorProveedores::ctrMostrarProveedores("id",$datos);
			$usuario= $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$proveedor    = 'Se elimino un proveedor';
			$descripcion   = 'El usuario '.$usuario.' elimino el proveedor '.$proveedor["codigo"].' - '.$proveedor["descripcion"];
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
			
			$respuesta = ModeloProveedores::mdlEliminarProveedor($tabla,$datos);
			if($respuesta == "ok"){
				
				
				echo'<script>

				swal({
					  type: "success",
					  title: "El proveedor ha sido anulado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "proveedor";

								}
							})

				</script>';

			}		

		}

	}    

}
