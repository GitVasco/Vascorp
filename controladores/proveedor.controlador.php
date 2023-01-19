<?php

class ControladorProveedores
{

	/*=============================================
	MOSTRAR ULTIMO CODIGO DE PROVEEDOR
	=============================================*/

	static public function ctrMostrarUltimoCodRuc()
	{
		$respuesta = ModeloProveedores::mdlMostrarUltimoCodRuc();

		return $respuesta;
	}

	/*=============================================
	MOSTRAR TIPO DE MONEDAS
	=============================================*/

	static public function ctrMostrarMonedas()
	{
		$respuesta = ModeloProveedores::mdlMostrarMonedas();

		return $respuesta;
	}

	/*=============================================
	CREAR PROVEEDOR
	=============================================*/

	static public function ctrCrearProveedor()
	{

		if (isset($_POST["nuevoRUC"])) {

			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$PcReg = gethostbyaddr($_SERVER['REMOTE_ADDR']);


			$tabla = "proveedor";
			$datos = array(

				"Cod_Local" => '01',
				"Cod_Entidad" => '01',
				"CodRuc" => $_POST["nuevoCodigoPro"],
				"TipPro" => $_POST["nuevoTipoProv"],
				"RucPro" => $_POST["nuevoRUC"],
				"RazPro" => $_POST["nuevaRazPro"],
				"DirPro" => $_POST["nuevaDireccion"],
				"UbiPro" => $_POST["nuevoUbiPro"],
				"TelPro1" => $_POST["nuevoTlf1"],
				"TelPro2" => $_POST["nuevoTlf2"],
				"TelPro3" => $_POST["nuevoTlf3"],
				"FaxPro" => $_POST["nuevoTlf4"],
				"ConPro" => $_POST["nuevoContacto"],
				"EmaPro" => $_POST["nuevoEmail1"],
				"EmaPro2" => $_POST["nuevoEmail2"],
				"WebPro" => $_POST["nuevaWeb"],
				"TieEnt" => $_POST["nuevoTipoEntr"],
				"ForPag" => $_POST["nuevaFormaPago"],
				"Dia" => $_POST["nuevoDias"],

				"Banco" => $_POST["nuevoBanco"],
				"Moneda" => $_POST["nuevaMoneda"],
				"NroCta" => $_POST["nuevoNroCuenta"],
				"Cci" => $_POST["nuevoCci"],

				"Banco1" => $_POST["nuevoBanco1"],
				"Moneda1" => $_POST["nuevaMoneda1"],
				"NroCta1" => $_POST["nuevoNroCuenta1"],
				"Cci1" => $_POST["nuevoCci1"],

				"Banco2" => $_POST["nuevoBanco2"],
				"Moneda2" => $_POST["nuevaMoneda2"],
				"NroCta2" => $_POST["nuevoNroCuenta2"],
				"Cci2" => $_POST["nuevoCci2"],

				"Banco3" => $_POST["nuevoBanco3"],
				"Moneda3" => $_POST["nuevaMoneda3"],
				"NroCta3" => $_POST["nuevoNroCuenta3"],
				"Cci3" => $_POST["nuevoCci3"],


				"EstPro" => '1',
				"Observa" => $_POST["nuevaObservacion"],
				"FecReg" => $fecha->format("Y-m-d H:i:s"),
				"PcReg" => $PcReg,
				"UsuReg" => $_SESSION["id"]
			);

			$respuesta = ModeloProveedores::mdlIngresarProveedor($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

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

	static public function ctrMostrarProveedores($item, $valor)
	{
		$tabla = "proveedor";
		$respuesta = ModeloProveedores::mdlMostrarProveedores($tabla, $item, $valor);

		return $respuesta;
	}



	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/

	static public function ctrEditarProveedor()
	{

		if (isset($_POST["editarRUC"])) {

			$tabla = "proveedor";

			$datos = array(
				"CodRuc" => $_POST["editarCodigoPro"],
				"TipPro" => $_POST["editarTipoProv"],
				"RucPro" => $_POST["editarRUC"],
				"RazPro" => $_POST["editarRazPro"],
				"DirPro" => $_POST["editarDireccion"],
				"UbiPro" => $_POST["editarUbiPro"],
				"TelPro1" => $_POST["editarTlf1"],
				"TelPro2" => $_POST["editarTlf2"],
				"TelPro3" => $_POST["editarTlf3"],
				"FaxPro" => $_POST["editarTlf4"],
				"ConPro" => $_POST["editarContacto"],
				"EmaPro" => $_POST["editarEmail1"],
				"EmaPro2" => $_POST["editarEmail2"],
				"WebPro" => $_POST["editarWeb"],
				"TieEnt" => $_POST["editarTipoEntr"],
				"ForPag" => $_POST["editarFormaPago"],
				"Dia" => $_POST["editarDias"],

				"Banco" => $_POST["editarBanco"],
				"Moneda" => $_POST["editarMoneda"],
				"NroCta" => $_POST["editarNroCuenta"],
				"Cci" => $_POST["editarCci"],

				"Banco1" => $_POST["editarBanco1"],
				"Moneda1" => $_POST["editarMoneda1"],
				"NroCta1" => $_POST["editarNroCuenta1"],
				"Cci1" => $_POST["editarCci1"],

				"Banco2" => $_POST["editarBanco2"],
				"Moneda2" => $_POST["editarMoneda2"],
				"NroCta2" => $_POST["editarNroCuenta2"],
				"Cci2" => $_POST["editarCci2"],

				"Banco3" => $_POST["editarBanco3"],
				"Moneda3" => $_POST["editarMoneda3"],
				"NroCta3" => $_POST["editarNroCuenta3"],
				"Cci3" => $_POST["editarCci3"]
			);

			$respuesta = ModeloProveedores::mdlEditarProveedor($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

					swal({
						  type: "success",
						  title: "El proveedor ha sido cambiado correctamente",
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
	ANULAR PROVEEDOR
	=============================================*/

	static public function ctrEliminarProveedor()
	{

		if (isset($_GET["CodRuc"])) {

			$datos = $_GET["CodRuc"];
			$tabla = "proveedor";
			$PcAnu = gethostbyaddr($_SERVER['REMOTE_ADDR']);

			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$proveedor = ControladorProveedores::ctrMostrarProveedores("CodRuc", $datos);
			$usuario = $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se anulo un proveedor';
			$descripcion   = 'El usuario ' . $usuario . ' anulo el proveedor ' . $proveedor["CodRuc"] . ' - ' . $proveedor["RazPro"];
			$de = 'From: notificacionesvascorp@gmail.com';
			if ($_SESSION["correo"] == 1) {
				mail($para, $asunto, $descripcion, $de);
			}
			if ($_SESSION["datos"] == 1) {
				$datos2 = array(
					"usuario" => $usuario,
					"concepto" => $descripcion,
					"fecha" => $fecha->format("Y-m-d H:i:s")
				);
				$auditoria = ModeloUsuarios::mdlIngresarAuditoria("auditoriajf", $datos2);
			}
			$datosAnulado = array(
				"CodRuc" => $_GET["CodRuc"],
				"UsuAnu" => $_SESSION["nombre"],
				"PcAnu" => $PcAnu,
				"FecAnu" => $fecha->format("Y-m-d H:i:s")
			);
			$respuesta = ModeloProveedores::mdlEliminarProveedor($tabla, $datosAnulado);
			if ($respuesta == "ok") {


				echo '<script>

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
