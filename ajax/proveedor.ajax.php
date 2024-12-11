<?php

require_once "../controladores/proveedor.controlador.php";
require_once "../modelos/proveedor.modelo.php";

class AjaxProveedores
{

	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/

	public $CodRuc;

	public function ajaxEditarProveedor()
	{

		$item = "CodRuc";
		$valor = $this->CodRuc;

		$respuesta = ControladorProveedores::ctrMostrarProveedores($item, $valor);

		echo json_encode($respuesta);
	}

	/*=============================================
	VALIDAR RUC PROVEEDOR
	=============================================*/
	public $RucPro;
	public function ajaxValidarRuc()
	{

		$item = "RucPro";
		$valor = $this->RucPro;
		$respuesta = ControladorProveedores::ctrMostrarProveedores($item, $valor);

		echo json_encode($respuesta);
	}

	/*=============================================
	CONSULTAR RUC PROVEEDOR O CLIENTE
	=============================================*/
	public $nuevoRuc;
	public function ajaxConsultarRUC()
	{

		$valor = $this->nuevoRuc;

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.factiliza.com/pe/v1/ruc/info/' . $valor,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI0MzQiLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL3JvbGUiOiJjb25zdWx0b3IifQ.jZ8p-bhKWZskL9WsxY_BFUH0TQ6uHQ9etpQ6yS7Od3M'
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}
	}
}

/*=============================================
EDITAR PROVEEDOR
=============================================*/

if (isset($_POST["CodRuc"])) {

	$cliente = new AjaxProveedores();
	$cliente->CodRuc = $_POST["CodRuc"];
	$cliente->ajaxEditarProveedor();
}

/*=============================================
VALIDAR RUC PROVEEDOR
=============================================*/
if (isset($_POST["RucPro"])) {
	$validarDocumento = new AjaxProveedores();
	$validarDocumento->RucPro = $_POST["RucPro"];
	$validarDocumento->ajaxValidarRuc();
}


/*=============================================
CONSULTAR RUC PROVEEDOR O CLIENTE
=============================================*/

if (isset($_POST["nuevoRuc"])) {

	$consultarRuc = new AjaxProveedores();
	$consultarRuc->nuevoRuc = $_POST["nuevoRuc"];
	$consultarRuc->ajaxConsultarRUC();
}
